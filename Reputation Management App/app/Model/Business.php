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
class Business extends AppModel {
var $virtualFields = array('totalReviews'=>'SELECT COUNT(*) FROM business_reviews br WHERE br.business_id = Business.id AND br.authorization=1 AND br.confirmation=1','lastReviewdate'=>'SELECT `ratingdate` FROM business_reviews br WHERE br.business_id = Business.id AND br.authorization=1 AND br.confirmation=1 ORDER BY br.id DESC LIMIT 1','averageRating'=>'SELECT AVG(`ratingstar`) FROM business_reviews br WHERE br.business_id = Business.id AND br.authorization=1 AND br.confirmation=1','onestarCount'=>'SELECT count(`ratingstar`) FROM business_reviews br WHERE br.business_id = Business.id AND br.ratingstar=1 AND br.authorization=1 AND br.confirmation=1','twostarCount'=>'SELECT count(`ratingstar`) FROM business_reviews br WHERE br.business_id = Business.id AND br.ratingstar=2 AND br.authorization=1 AND br.confirmation=1','threestarCount'=>'SELECT count(`ratingstar`) FROM business_reviews br WHERE br.business_id = Business.id AND br.ratingstar=3 AND br.authorization=1 AND br.confirmation=1','fourstarCount'=>'SELECT count(`ratingstar`) FROM business_reviews br WHERE br.business_id = Business.id AND br.ratingstar=4 AND br.authorization=1 AND br.confirmation=1','fivestarCount'=>'SELECT count(`ratingstar`) FROM business_reviews br WHERE br.business_id = Business.id AND br.ratingstar=5 AND br.authorization=1 AND br.confirmation=1','category'=>'SELECT `name` from business_categories bc WHERE bc.id=Business.business_category_id','countryname'=>'SELECT `country_name` from countries cont WHERE cont.id=Business.country','statename'=>'SELECT `stateName` from states st WHERE st.id=Business.state','cityname'=>'SELECT `city_name` from cities ct WHERE ct.id=Business.city','agencyname'=>'SELECT agencyname FROM agencysite_settings ur WHERE ur.user_id = Business.agency_id','agencyemail'=>'SELECT email FROM users ur WHERE ur.id = Business.agency_id');	
public $actsAs = array('Containable');
/**
 * Validation rules
 *
 * @var array
 */


		
	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
		'BusinessCategory' => array(
			'className' => 'BusinessCategory',
			'foreignKey' => 'business_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'State' => array(
			'className' => 'State',
			'foreignKey' => 'state',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'city',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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
	public $hasMany = array(
		'BusinessEmployee' => array(
			'className' => 'BusinessEmployee',
			'foreignKey' => 'business_id',
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
			'foreignKey' => 'business_id',
			'dependent' => false,
			'conditions' => array('BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1),
			'fields' => '',
			'order' => array('BusinessReview.id DESC'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'BusinessSocialMedia' => array(
			'className' => 'BusinessSocialMedia',
			'foreignKey' => 'business_id',
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
		/*'ChildBusiness' => array(
			'className' => 'Business',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),*/
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'business_id',
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
		'EmailTemplate' => array(
			'className' => 'EmailTemplate',
			'foreignKey' => 'business_id',
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
		'FeedbackSetting' => array(
			'className' => 'FeedbackSetting',
			'foreignKey' => 'business_id',
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
		'Visibility' => array(
			'className' => 'Visibility',
			'foreignKey' => 'business_id',
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
