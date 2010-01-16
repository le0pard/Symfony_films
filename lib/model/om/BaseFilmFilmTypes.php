<?php

/**
 * Base class that represents a row from the 'film_film_types' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Sat Jan 16 01:58:00 2010
 *
 * @package    lib.model.om
 */
abstract class BaseFilmFilmTypes extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        FilmFilmTypesPeer
	 */
	protected static $peer;

	/**
	 * The value for the film_id field.
	 * @var        int
	 */
	protected $film_id;

	/**
	 * The value for the film_genre_id field.
	 * @var        int
	 */
	protected $film_genre_id;

	/**
	 * @var        Film
	 */
	protected $aFilm;

	/**
	 * @var        FilmTypes
	 */
	protected $aFilmTypes;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	// symfony behavior
	
	const PEER = 'FilmFilmTypesPeer';

	/**
	 * Get the [film_id] column value.
	 * 
	 * @return     int
	 */
	public function getFilmId()
	{
		return $this->film_id;
	}

	/**
	 * Get the [film_genre_id] column value.
	 * 
	 * @return     int
	 */
	public function getFilmGenreId()
	{
		return $this->film_genre_id;
	}

	/**
	 * Set the value of [film_id] column.
	 * 
	 * @param      int $v new value
	 * @return     FilmFilmTypes The current object (for fluent API support)
	 */
	public function setFilmId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->film_id !== $v) {
			$this->film_id = $v;
			$this->modifiedColumns[] = FilmFilmTypesPeer::FILM_ID;
		}

		if ($this->aFilm !== null && $this->aFilm->getId() !== $v) {
			$this->aFilm = null;
		}

		return $this;
	} // setFilmId()

	/**
	 * Set the value of [film_genre_id] column.
	 * 
	 * @param      int $v new value
	 * @return     FilmFilmTypes The current object (for fluent API support)
	 */
	public function setFilmGenreId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->film_genre_id !== $v) {
			$this->film_genre_id = $v;
			$this->modifiedColumns[] = FilmFilmTypesPeer::FILM_GENRE_ID;
		}

		if ($this->aFilmTypes !== null && $this->aFilmTypes->getId() !== $v) {
			$this->aFilmTypes = null;
		}

		return $this;
	} // setFilmGenreId()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->film_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->film_genre_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 2; // 2 = FilmFilmTypesPeer::NUM_COLUMNS - FilmFilmTypesPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating FilmFilmTypes object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aFilm !== null && $this->film_id !== $this->aFilm->getId()) {
			$this->aFilm = null;
		}
		if ($this->aFilmTypes !== null && $this->film_genre_id !== $this->aFilmTypes->getId()) {
			$this->aFilmTypes = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FilmFilmTypesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = FilmFilmTypesPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aFilm = null;
			$this->aFilmTypes = null;
		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FilmFilmTypesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseFilmFilmTypes:delete:pre') as $callable)
			{
			  if ($ret = call_user_func($callable, $this, $con))
			  {
			    return;
			  }
			}

			if ($ret) {
				FilmFilmTypesPeer::doDelete($this, $con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseFilmFilmTypes:delete:post') as $callable)
				{
				  call_user_func($callable, $this, $con);
				}

				$this->setDeleted(true);
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FilmFilmTypesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseFilmFilmTypes:save:pre') as $callable)
			{
			  if (is_integer($affectedRows = call_user_func($callable, $this, $con)))
			  {
			    return $affectedRows;
			  }
			}

			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseFilmFilmTypes:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				$con->commit();
				FilmFilmTypesPeer::addInstanceToPool($this);
				return $affectedRows;
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aFilm !== null) {
				if ($this->aFilm->isModified() || $this->aFilm->isNew()) {
					$affectedRows += $this->aFilm->save($con);
				}
				$this->setFilm($this->aFilm);
			}

			if ($this->aFilmTypes !== null) {
				if ($this->aFilmTypes->isModified() || $this->aFilmTypes->isNew()) {
					$affectedRows += $this->aFilmTypes->save($con);
				}
				$this->setFilmTypes($this->aFilmTypes);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FilmFilmTypesPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += FilmFilmTypesPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aFilm !== null) {
				if (!$this->aFilm->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFilm->getValidationFailures());
				}
			}

			if ($this->aFilmTypes !== null) {
				if (!$this->aFilmTypes->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFilmTypes->getValidationFailures());
				}
			}


			if (($retval = FilmFilmTypesPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FilmFilmTypesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getFilmId();
				break;
			case 1:
				return $this->getFilmGenreId();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = FilmFilmTypesPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getFilmId(),
			$keys[1] => $this->getFilmGenreId(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FilmFilmTypesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setFilmId($value);
				break;
			case 1:
				$this->setFilmGenreId($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FilmFilmTypesPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setFilmId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFilmGenreId($arr[$keys[1]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(FilmFilmTypesPeer::DATABASE_NAME);

		if ($this->isColumnModified(FilmFilmTypesPeer::FILM_ID)) $criteria->add(FilmFilmTypesPeer::FILM_ID, $this->film_id);
		if ($this->isColumnModified(FilmFilmTypesPeer::FILM_GENRE_ID)) $criteria->add(FilmFilmTypesPeer::FILM_GENRE_ID, $this->film_genre_id);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FilmFilmTypesPeer::DATABASE_NAME);

		$criteria->add(FilmFilmTypesPeer::FILM_ID, $this->film_id);
		$criteria->add(FilmFilmTypesPeer::FILM_GENRE_ID, $this->film_genre_id);

		return $criteria;
	}

	/**
	 * Returns the composite primary key for this object.
	 * The array elements will be in same order as specified in XML.
	 * @return     array
	 */
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getFilmId();

		$pks[1] = $this->getFilmGenreId();

		return $pks;
	}

	/**
	 * Set the [composite] primary key.
	 *
	 * @param      array $keys The elements of the composite key (order must match the order in XML file).
	 * @return     void
	 */
	public function setPrimaryKey($keys)
	{

		$this->setFilmId($keys[0]);

		$this->setFilmGenreId($keys[1]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of FilmFilmTypes (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setFilmId($this->film_id);

		$copyObj->setFilmGenreId($this->film_genre_id);


		$copyObj->setNew(true);

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     FilmFilmTypes Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     FilmFilmTypesPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new FilmFilmTypesPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Film object.
	 *
	 * @param      Film $v
	 * @return     FilmFilmTypes The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setFilm(Film $v = null)
	{
		if ($v === null) {
			$this->setFilmId(NULL);
		} else {
			$this->setFilmId($v->getId());
		}

		$this->aFilm = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Film object, it will not be re-added.
		if ($v !== null) {
			$v->addFilmFilmTypes($this);
		}

		return $this;
	}


	/**
	 * Get the associated Film object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Film The associated Film object.
	 * @throws     PropelException
	 */
	public function getFilm(PropelPDO $con = null)
	{
		if ($this->aFilm === null && ($this->film_id !== null)) {
			$this->aFilm = FilmPeer::retrieveByPk($this->film_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aFilm->addFilmFilmTypess($this);
			 */
		}
		return $this->aFilm;
	}

	/**
	 * Declares an association between this object and a FilmTypes object.
	 *
	 * @param      FilmTypes $v
	 * @return     FilmFilmTypes The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setFilmTypes(FilmTypes $v = null)
	{
		if ($v === null) {
			$this->setFilmGenreId(NULL);
		} else {
			$this->setFilmGenreId($v->getId());
		}

		$this->aFilmTypes = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the FilmTypes object, it will not be re-added.
		if ($v !== null) {
			$v->addFilmFilmTypes($this);
		}

		return $this;
	}


	/**
	 * Get the associated FilmTypes object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     FilmTypes The associated FilmTypes object.
	 * @throws     PropelException
	 */
	public function getFilmTypes(PropelPDO $con = null)
	{
		if ($this->aFilmTypes === null && ($this->film_genre_id !== null)) {
			$this->aFilmTypes = FilmTypesPeer::retrieveByPk($this->film_genre_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aFilmTypes->addFilmFilmTypess($this);
			 */
		}
		return $this->aFilmTypes;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

			$this->aFilm = null;
			$this->aFilmTypes = null;
	}

	// symfony_behaviors behavior
	
	/**
	 * Calls methods defined via {@link sfMixer}.
	 */
	public function __call($method, $arguments)
	{
	  if (!$callable = sfMixer::getCallable('BaseFilmFilmTypes:'.$method))
	  {
	    throw new sfException(sprintf('Call to undefined method BaseFilmFilmTypes::%s', $method));
	  }
	
	  array_unshift($arguments, $this);
	
	  return call_user_func_array($callable, $arguments);
	}

} // BaseFilmFilmTypes
