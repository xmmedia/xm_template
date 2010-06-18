<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Claero Template controller.
 */
class Controller_Template extends Kohana_Controller_Template {
    // Template file to use
    public $template = 'templates/main';
    
    // Auth object
    protected $auth;
    
    // Currently logged-in user
    protected $user;
    
    // Roles required to perform current action (must satisfy all)
    protected $roles_required = array();
    
    // What section of the site the user is in
    protected $section = 'home';
    
    /**
     * If required, ensure user is logged in and has roles required to perform selected action.
     */
    public function before() {
        parent::before();
        
        $this->init_template();
        $this->perform_auth();
    }
    
    /**
     * Initialize template variables.
     */
    private function init_template() {
        // Page content
        $this->template->content = '';
        
        // Page CSS
        $this->template->css = array();
        
        // Page scripts
        $this->template->scripts = array();
        
        // Flash message
        $this->template->message = Flash::get('message');
        
        // Page menus
        $this->template->menus = array(
            'home' => array(
                'link'      => '/',
                'text'      => 'Home',
                'active'    => ('home' == $this->section)
            ),
            'groups' => array(
                'link'      => '/admin/groups',
                'text'      => 'Groups',
                'active'    => ('groups' == $this->section)
            ),
            'users' => array(
                'link'      => '/admin/users',
                'text'      => 'Users',
                'active'    => ('users' == $this->section)
            ),
        );
    }
    
    /**
     * Perform authorization.
     */
    private function perform_auth() {
        $this->auth = Auth::instance();
        
        // Get current user
        $this->user = $this->auth->get_user();
        
        // Add user to template
        $this->template->user = $this->user;
        
        // If page requires roles
        if (count($this->roles_required) > 0) {
            // If we have a user
            if (false !== $this->user) {
                try {
                    $this->user->authorize($this->roles_required);
                }
                // User is not authorized
                catch (Exception_NotAuthorized $e) {
                    // Display the "Not Authorized" warning
                    $this->template->content = View::factory(
                        Kohana::config('site.not_authed_view'), array(
                            'roles' => $e->missing_roles
                        )
                    );
                    
                    echo $this->template;
                    exit;
                }
            }
            // If user is not logged in
            else {
                // Redirect to login page
                Flash::set('message', 'You must log in to perform this action.');
                Flash::set('return_to', $this->request->uri);
                $this->request->redirect('/account/login');
            }
        }
    }
    
    /**
     * Returns error messages from a validation exception.
     *
     * @param Validate_Exception $e        The exception to extract error messages from.
     * @param string             $messages The file that contains the error messages.
     */
    protected function get_error_messages($e, $messages) {
        return implode('<br />', array_values($e->array->errors($messages)));
    }
}
