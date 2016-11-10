<?php
App::uses('AppModel', 'Model');
/**
 * Business Model
 *
 * @property Business $ParentBusiness
 * @property BusinessCategory $BusinessCategory
 * @property BusinessEmployee $BusinessEmployee
 * @property BusinessReview $BusinessReview
 * @property BusinessSocialMedia $BusinessSocialMedia
 * @property Business $ChildBusiness
 * @property Customer $Customer
 * @property EmailTemplate $EmailTemplate
 * @property FeedbackSetting $FeedbackSetting
 * @property Visibility $Visibility
 */
class Onlinereview extends AppModel {
	 //pr($this->Onlinereview->query('SELECT social_media_id, COUNT(*) FROM onlinereviews GROUP BY social_media_id'));die;
//var $virtualFields = array('id_times'=>'SELECT social_media_id, count(*) FROM onlinereviews GROUP BY social_media_id');
public $actsAs = array('Containable');
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		// 'ParentBusiness' => array(
		// 	'className' => 'Business',
		// 	'foreignKey' => 'parent_id',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => ''
		// ),
		'socialMedia' => array(
			'className' => 'socialMedia',
			'foreignKey' => 'social_media_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
	 	)
	 

	);

/**
 * hasMany associations
 *
 * @var array
 */
	 
}
