<?php
App::uses('AppModel', 'Model');
/**
 * Visibility Model
 *
 * @property Business $Business
 * @property SocialMedia $SocialMedia
 */
class Visibility extends AppModel {
var $virtualFields = array('socialmediaName'=>'SELECT `mediasitename` FROM social_media sm WHERE sm.id = Visibility.social_media_id','checkerType'=>'SELECT `accounttype` FROM social_media sm WHERE sm.id = Visibility.social_media_id','status1'=>'SELECT `status` FROM social_media sm WHERE sm.id = Visibility.social_media_id');

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Business' => array(
			'className' => 'Business',
			'foreignKey' => 'business_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SocialMedia' => array(
			'className' => 'SocialMedia',
			'foreignKey' => 'social_media_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
