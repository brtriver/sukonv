<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace lithium\tests\mocks\data\model;

class MockDatabaseComment extends \lithium\data\Model {

	public $belongsTo = array('MockDatabasePost');

	protected $_meta = array(
		'connection' => 'mock-database-connection'
	);

	protected $_schema = array(
		'id' => array('type' => 'integer'),
		'post_id' => array('type' => 'integer'),
		'author_id' => array('type' => 'integer'),
		'body' => array('type' => 'text'),
		'created' => array('type' => 'datetime')
	);
}

?>