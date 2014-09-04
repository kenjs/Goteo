<?php
/*
 *  Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
 *	This file is part of Goteo.
 *
 *  Goteo is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Goteo is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with Goteo.  If not, see <http://www.gnu.org/licenses/agpl.txt>.
 *
 */

namespace Goteo\Controller {

    use Goteo\Model,
        Goteo\Model\User;

    class JSON extends \Goteo\Core\Controller {

		private $result = array();
        private $result2 = array();

		/**
		 * Solo retorna si la sesion esta activa o no
		 * */
		public function keep_alive() {

			$this->result = array(
				'logged'=>false
			);
			if($_SESSION['user'] instanceof User) {
				$this->result['logged'] = true;
				$this->result['userid'] = $_SESSION['user']->id;
			}

			return $this->output();
		}

        /**
         * API interfaces for LocalGood
         * */

        public function get_skill_list() {

            $this->result2[] = \Goteo\Model\Skill::getList();

            return $this->output2();

        }

//        public function get_skill_list() {
//
//            $this->result2[] = \Goteo\Model\Skill::getList();
//
//            return $this->output2();
//
//        }

        public function get_users(){
            // parameters
            //  skillid -> Skill ID
            //  userid -> user id
            //  username -> user name
            //  interest -> interest
            //  type -> user type

            $params = array();

            if (!empty($_REQUEST['skillid']))
                $params['skill'] = $_REQUEST['skillid'];

            if (!empty($_REQUEST['userid']))
                $params['id'] = $_REQUEST['id'];

            if (!empty($_REQUEST['username']))
                $params['name'] = $_REQUEST['username'];

            if (!empty($_REQUEST['interest']))
                $params['interest'] = $_REQUEST['interest'];

            if (!empty($_REQUEST['type'])){
                switch ($_REQUEST['type']) {
                    case 'creators':
                        $params['type'] = 'creators';
                        break;
                    case 'investors':
                        $params['type'] = 'investos';
                        break;
                    case 'supporters':
                        $params['type'] = 'supporters';
                        break;
                    case 'lurkers':
                        $params['type'] = 'lurkers';
                        break;
                }
            }

            if (!empty($params)){
                $this->result2[] = \Goteo\Model\User::getAll($params);
            }

            return $this->output2();
        }


        public function get_projects_by_skill() {

            $params = array('skills'=>array(), 'category'=>array(), 'location'=>array(), 'reward'=>array());

            $params['skills'][] = $_REQUEST['skillid'];

            $params['query'] = '';

//            ob_start();
//            echo \Goteo\Library\Search::params($params);
//            $this->result2[] = ob_get_contents();
//            ob_end_flush();

            $this->result2[] = \Goteo\Library\Search::params($params);

            return $this->output2();

        }

		/**
		 * Json encoding...
		 * */
		public function output() {

			header("Content-Type: application/json; charset=utf-8");

			return json_encode($this->result);
		}

        public function output2() {
            header("Content-Type: application/json; charset=utf-8");
//            return var_dump($this->result2);
            return json_encode($this->result2);
        }

    }
}
