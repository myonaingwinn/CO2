<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');


        $this->loadComponent('Auth', [
            'authorize' => 'Controller',
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ],
                    'scope' => [
                        'verified' => '1'
                    ],
                    'userModel ' => [
                        'Users'
                    ]
                ]
            ],

            'loginRedirect' => [
                'controller' => 'Co2datadetails',
                'action' => 'index'
            ],

            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],

            'storage' => 'Session'


        ]);

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    public function isAuthorized($user)
    {
        if ($this->Auth->user('role') == 'A') {
            return true;
        }
        return false;
    }

    public function beforeFilter(EventInterface $event)
    {
        if ($this->Auth->user()) {
            $this->set('Auser', $this->Auth->user());

            if ($this->Auth->user('role') == 'A') {
                $this->Auth->allow(['index', 'logout', 'add', 'notify', 'search', 'edit', 'csv', 'view', 'detail', 'onetimedata', 'csvdownload', 'getData']);
            } else {
                $this->Auth->allow(['index', 'logout', 'notify', 'csv', 'detail', 'onetimedata', 'csvdownload', 'getData']);
            }
        } else {
            $this->set('Auser', null);
        }

        $this->Auth->allow(['login', 'forgotpassword', 'resetpassword']);
        $this->Auth->setConfig('authError', "おっとっと、このエリアにアクセスする権限がありません！");
    }
}
