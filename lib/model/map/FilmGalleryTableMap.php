<?php


/**
 * This class defines the structure of the 'film_gallery' table.
 *
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Fri Jan 15 21:03:22 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class FilmGalleryTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.FilmGalleryTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('film_gallery');
		$this->setPhpName('FilmGallery');
		$this->setClassname('FilmGallery');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignPrimaryKey('FILM_ID', 'FilmId', 'INTEGER' , 'film', 'ID', true, null, null);
		$this->addColumn('THUMB_IMG', 'ThumbImg', 'VARCHAR', true, 500, null);
		$this->addColumn('NORMAL_IMG', 'NormalImg', 'VARCHAR', true, 500, null);
		$this->addColumn('SORT', 'Sort', 'INTEGER', false, null, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Film', 'Film', RelationMap::MANY_TO_ONE, array('film_id' => 'id', ), 'CASCADE', null);
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // FilmGalleryTableMap
