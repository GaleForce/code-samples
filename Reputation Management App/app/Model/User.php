<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property AgencysiteSetting $AgencysiteSetting
 * @property BusinessEmployee $BusinessEmployee
 * @property BusinessReview $BusinessReview
 * @property Customer $Customer
 * @property UserHistory $UserHistory
 */
class User extends AppModel {
var $virtualFields = array('lastlogin'=>'SELECT `lastlogin` FROM user_histories uh WHERE uh.user_id = User.id ORDER BY uh.id DESC LIMIT 1','agencyname'=>'SELECT agencyname FROM agencysite_settings ur WHERE ur.user_id = User.id');

/**
 * Validation rules
 *
 * @var array
 */	
	public function beforeSave($options = array()) {
		   if(isset($this->data['User']['password'])){
		   		$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		   }
	}
	
	public $validate = array(
		'email' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'createdat' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'AgencysiteSetting' => array(
			'className' => 'AgencysiteSetting',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'BusinessEmployee' => array(
			'className' => 'BusinessEmployee',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'BusinessReview' => array(
			'className' => 'BusinessReview',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'UserHistory' => array(
			'className' => 'UserHistory',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => array('UserHistory.id'=>'DESC'),
			'limit' => '1',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	public $hasOne = array(
		'Business' => array(
			'className' => 'Business',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
