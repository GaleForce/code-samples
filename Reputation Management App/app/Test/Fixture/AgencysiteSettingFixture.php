<?php
/**
 * AgencysiteSettingFixture
 *
 */
class AgencysiteSettingFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index', 'comment' => 'Id of Reseller User'),
		'sitetitle' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'siteheadcolor' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'sitebarcolor' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'sitebackgroundcolor' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'sitebackgroundimageurl' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'faviconimageurl' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'effectivedate' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'terminationdate' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'settingsdescription' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created_at' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated_at' => array('type' => 'timestamp', 'null' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_user_id' => array('column' => 'user_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'sitetitle' => 'Lorem ipsum dolor sit amet',
			'siteheadcolor' => 'Lorem ipsum dolor sit amet',
			'sitebarcolor' => 'Lorem ipsum dolor sit amet',
			'sitebackgroundcolor' => 'Lorem ipsum dolor sit amet',
			'sitebackgroundimageurl' => 'Lorem ipsum dolor sit amet',
			'faviconimageurl' => 'Lorem ipsum dolor sit amet',
			'effectivedate' => '2014-12-20 11:59:59',
			'terminationdate' => '2014-12-20 11:59:59',
			'settingsdescription' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created_at' => '2014-12-20 11:59:59',
			'updated_at' => 1419056999
		),
	);

}
