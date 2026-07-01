<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MY_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function log($message = null, $record_id = null, $action = null)
    {
        $user_id = $this->customlib->getStaffID();

        if ($user_id == NULL) {
            $user_id = "";
        }

        $ip = $this->input->ip_address();

        if ($this->agent->is_browser()) {
            $agent = $this->agent->browser() . ' ' . $this->agent->version();
        } elseif ($this->agent->is_robot()) {
            $agent = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {

            $agent = $this->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }

        $platform = $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.)

        $insert = array(
            'message'    => $message,
            'user_id'    => $user_id,
            'record_id'  => $record_id,
            'ip_address' => $ip,
            'platform'   => $platform,
            'agent'      => $agent,
            'action'     => $action,
            'time'       => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d'),
        );

        $this->db->insert('logs', $insert);
    }

    /**
     * Gets the active tenant ID for the session.
     * Returns false if the user is a Super Admin (can see all).
     */
    public function get_tenant_id()
    {
        if ($this->session->userdata('mr_sadmin') == '1') {
            return false;
        }
        
        // If Company Admin, Tenant ID is their own ID
        if ($this->session->userdata('mr_admin') == '1') {
            return $this->session->userdata('mr_id');
        }

        // If Staff (Subuser), Tenant ID is their Parent Company ID
        $cmpyid = $this->session->userdata('mr_cmpyid');
        if (!empty($cmpyid)) {
            return $cmpyid;
        }

        // If standard/independent user, Tenant ID is their own ID
        return $this->session->userdata('mr_id');
    }

    /**
     * Injects the tenant scoping WHERE clause into the active CodeIgniter query builder.
     * 
     * @param string $column The column name that holds the tenant ID (default 'cmpyid').
     * @param string $table_alias Optional table alias (e.g. 'users u' -> 'u.cmpyid').
     * @return $this Allows method chaining.
     */
    public function scope_tenant($column = 'cmpyid', $table_alias = '')
    {
        $tenant_id = $this->get_tenant_id();
        
        if ($tenant_id !== false) {
            $prefix = !empty($table_alias) ? $table_alias . '.' : '';
            $this->db->where($prefix . $column, $tenant_id);
        }
        
        return $this;
    }
}
