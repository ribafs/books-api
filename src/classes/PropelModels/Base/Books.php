<?php

namespace PropelModels\Base;

use \Exception;
use \PDO;
use PropelModels\Books as ChildBooks;
use PropelModels\BooksByAuthors as ChildBooksByAuthors;
use PropelModels\BooksByAuthorsQuery as ChildBooksByAuthorsQuery;
use PropelModels\BooksByCategories as ChildBooksByCategories;
use PropelModels\BooksByCategoriesQuery as ChildBooksByCategoriesQuery;
use PropelModels\BooksByUser as ChildBooksByUser;
use PropelModels\BooksByUserQuery as ChildBooksByUserQuery;
use PropelModels\BooksQuery as ChildBooksQuery;
use PropelModels\Map\BooksByAuthorsTableMap;
use PropelModels\Map\BooksByCategoriesTableMap;
use PropelModels\Map\BooksByUserTableMap;
use PropelModels\Map\BooksTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'books' table.
 *
 *
 *
 * @package    propel.generator.PropelModels.Base
 */
abstract class Books implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\PropelModels\\Map\\BooksTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the title field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $title;

    /**
     * The value for the year field.
     *
     * Note: this column has a database default value of: 1970
     * @var        int
     */
    protected $year;

    /**
     * @var        ObjectCollection|ChildBooksByAuthors[] Collection to store aggregation of ChildBooksByAuthors objects.
     */
    protected $collBooksByAuthorss;
    protected $collBooksByAuthorssPartial;

    /**
     * @var        ObjectCollection|ChildBooksByCategories[] Collection to store aggregation of ChildBooksByCategories objects.
     */
    protected $collBooksByCategoriess;
    protected $collBooksByCategoriessPartial;

    /**
     * @var        ObjectCollection|ChildBooksByUser[] Collection to store aggregation of ChildBooksByUser objects.
     */
    protected $collBooksByUsers;
    protected $collBooksByUsersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBooksByAuthors[]
     */
    protected $booksByAuthorssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBooksByCategories[]
     */
    protected $booksByCategoriessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBooksByUser[]
     */
    protected $booksByUsersScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->title = '';
        $this->year = 1970;
    }

    /**
     * Initializes internal state of PropelModels\Base\Books object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Books</code> instance.  If
     * <code>obj</code> is an instance of <code>Books</code>, delegates to
     * <code>equals(Books)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Books The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [title] column value.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the [year] column value.
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\PropelModels\Books The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[BooksTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return $this|\PropelModels\Books The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[BooksTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Set the value of [year] column.
     *
     * @param int $v new value
     * @return $this|\PropelModels\Books The current object (for fluent API support)
     */
    public function setYear($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->year !== $v) {
            $this->year = $v;
            $this->modifiedColumns[BooksTableMap::COL_YEAR] = true;
        }

        return $this;
    } // setYear()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->title !== '') {
                return false;
            }

            if ($this->year !== 1970) {
                return false;
            }

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
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : BooksTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : BooksTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : BooksTableMap::translateFieldName('Year', TableMap::TYPE_PHPNAME, $indexType)];
            $this->year = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = BooksTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\PropelModels\\Books'), 0, $e);
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
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BooksTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildBooksQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collBooksByAuthorss = null;

            $this->collBooksByCategoriess = null;

            $this->collBooksByUsers = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Books::setDeleted()
     * @see Books::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BooksTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildBooksQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BooksTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
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
                BooksTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->booksByAuthorssScheduledForDeletion !== null) {
                if (!$this->booksByAuthorssScheduledForDeletion->isEmpty()) {
                    \PropelModels\BooksByAuthorsQuery::create()
                        ->filterByPrimaryKeys($this->booksByAuthorssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->booksByAuthorssScheduledForDeletion = null;
                }
            }

            if ($this->collBooksByAuthorss !== null) {
                foreach ($this->collBooksByAuthorss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->booksByCategoriessScheduledForDeletion !== null) {
                if (!$this->booksByCategoriessScheduledForDeletion->isEmpty()) {
                    \PropelModels\BooksByCategoriesQuery::create()
                        ->filterByPrimaryKeys($this->booksByCategoriessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->booksByCategoriessScheduledForDeletion = null;
                }
            }

            if ($this->collBooksByCategoriess !== null) {
                foreach ($this->collBooksByCategoriess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->booksByUsersScheduledForDeletion !== null) {
                if (!$this->booksByUsersScheduledForDeletion->isEmpty()) {
                    \PropelModels\BooksByUserQuery::create()
                        ->filterByPrimaryKeys($this->booksByUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->booksByUsersScheduledForDeletion = null;
                }
            }

            if ($this->collBooksByUsers !== null) {
                foreach ($this->collBooksByUsers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[BooksTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BooksTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BooksTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(BooksTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'title';
        }
        if ($this->isColumnModified(BooksTableMap::COL_YEAR)) {
            $modifiedColumns[':p' . $index++]  = 'year';
        }

        $sql = sprintf(
            'INSERT INTO books (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'title':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case 'year':
                        $stmt->bindValue($identifier, $this->year, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = BooksTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getTitle();
                break;
            case 2:
                return $this->getYear();
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
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Books'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Books'][$this->hashCode()] = true;
        $keys = BooksTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getTitle(),
            $keys[2] => $this->getYear(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collBooksByAuthorss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'booksByAuthorss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'books_by_authorss';
                        break;
                    default:
                        $key = 'BooksByAuthorss';
                }

                $result[$key] = $this->collBooksByAuthorss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBooksByCategoriess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'booksByCategoriess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'books_by_categoriess';
                        break;
                    default:
                        $key = 'BooksByCategoriess';
                }

                $result[$key] = $this->collBooksByCategoriess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBooksByUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'booksByUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'books_by_users';
                        break;
                    default:
                        $key = 'BooksByUsers';
                }

                $result[$key] = $this->collBooksByUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\PropelModels\Books
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = BooksTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\PropelModels\Books
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setTitle($value);
                break;
            case 2:
                $this->setYear($value);
                break;
        } // switch()

        return $this;
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
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = BooksTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTitle($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setYear($arr[$keys[2]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\PropelModels\Books The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(BooksTableMap::DATABASE_NAME);

        if ($this->isColumnModified(BooksTableMap::COL_ID)) {
            $criteria->add(BooksTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(BooksTableMap::COL_TITLE)) {
            $criteria->add(BooksTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(BooksTableMap::COL_YEAR)) {
            $criteria->add(BooksTableMap::COL_YEAR, $this->year);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildBooksQuery::create();
        $criteria->add(BooksTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \PropelModels\Books (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTitle($this->getTitle());
        $copyObj->setYear($this->getYear());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBooksByAuthorss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBooksByAuthors($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBooksByCategoriess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBooksByCategories($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBooksByUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBooksByUser($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \PropelModels\Books Clone of current object.
     * @throws PropelException
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('BooksByAuthors' == $relationName) {
            $this->initBooksByAuthorss();
            return;
        }
        if ('BooksByCategories' == $relationName) {
            $this->initBooksByCategoriess();
            return;
        }
        if ('BooksByUser' == $relationName) {
            $this->initBooksByUsers();
            return;
        }
    }

    /**
     * Clears out the collBooksByAuthorss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBooksByAuthorss()
     */
    public function clearBooksByAuthorss()
    {
        $this->collBooksByAuthorss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBooksByAuthorss collection loaded partially.
     */
    public function resetPartialBooksByAuthorss($v = true)
    {
        $this->collBooksByAuthorssPartial = $v;
    }

    /**
     * Initializes the collBooksByAuthorss collection.
     *
     * By default this just sets the collBooksByAuthorss collection to an empty array (like clearcollBooksByAuthorss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBooksByAuthorss($overrideExisting = true)
    {
        if (null !== $this->collBooksByAuthorss && !$overrideExisting) {
            return;
        }

        $collectionClassName = BooksByAuthorsTableMap::getTableMap()->getCollectionClassName();

        $this->collBooksByAuthorss = new $collectionClassName;
        $this->collBooksByAuthorss->setModel('\PropelModels\BooksByAuthors');
    }

    /**
     * Gets an array of ChildBooksByAuthors objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBooks is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBooksByAuthors[] List of ChildBooksByAuthors objects
     * @throws PropelException
     */
    public function getBooksByAuthorss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBooksByAuthorssPartial && !$this->isNew();
        if (null === $this->collBooksByAuthorss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBooksByAuthorss) {
                // return empty collection
                $this->initBooksByAuthorss();
            } else {
                $collBooksByAuthorss = ChildBooksByAuthorsQuery::create(null, $criteria)
                    ->filterByBooks($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBooksByAuthorssPartial && count($collBooksByAuthorss)) {
                        $this->initBooksByAuthorss(false);

                        foreach ($collBooksByAuthorss as $obj) {
                            if (false == $this->collBooksByAuthorss->contains($obj)) {
                                $this->collBooksByAuthorss->append($obj);
                            }
                        }

                        $this->collBooksByAuthorssPartial = true;
                    }

                    return $collBooksByAuthorss;
                }

                if ($partial && $this->collBooksByAuthorss) {
                    foreach ($this->collBooksByAuthorss as $obj) {
                        if ($obj->isNew()) {
                            $collBooksByAuthorss[] = $obj;
                        }
                    }
                }

                $this->collBooksByAuthorss = $collBooksByAuthorss;
                $this->collBooksByAuthorssPartial = false;
            }
        }

        return $this->collBooksByAuthorss;
    }

    /**
     * Sets a collection of ChildBooksByAuthors objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $booksByAuthorss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBooks The current object (for fluent API support)
     */
    public function setBooksByAuthorss(Collection $booksByAuthorss, ConnectionInterface $con = null)
    {
        /** @var ChildBooksByAuthors[] $booksByAuthorssToDelete */
        $booksByAuthorssToDelete = $this->getBooksByAuthorss(new Criteria(), $con)->diff($booksByAuthorss);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->booksByAuthorssScheduledForDeletion = clone $booksByAuthorssToDelete;

        foreach ($booksByAuthorssToDelete as $booksByAuthorsRemoved) {
            $booksByAuthorsRemoved->setBooks(null);
        }

        $this->collBooksByAuthorss = null;
        foreach ($booksByAuthorss as $booksByAuthors) {
            $this->addBooksByAuthors($booksByAuthors);
        }

        $this->collBooksByAuthorss = $booksByAuthorss;
        $this->collBooksByAuthorssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BooksByAuthors objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BooksByAuthors objects.
     * @throws PropelException
     */
    public function countBooksByAuthorss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBooksByAuthorssPartial && !$this->isNew();
        if (null === $this->collBooksByAuthorss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBooksByAuthorss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBooksByAuthorss());
            }

            $query = ChildBooksByAuthorsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBooks($this)
                ->count($con);
        }

        return count($this->collBooksByAuthorss);
    }

    /**
     * Method called to associate a ChildBooksByAuthors object to this object
     * through the ChildBooksByAuthors foreign key attribute.
     *
     * @param  ChildBooksByAuthors $l ChildBooksByAuthors
     * @return $this|\PropelModels\Books The current object (for fluent API support)
     */
    public function addBooksByAuthors(ChildBooksByAuthors $l)
    {
        if ($this->collBooksByAuthorss === null) {
            $this->initBooksByAuthorss();
            $this->collBooksByAuthorssPartial = true;
        }

        if (!$this->collBooksByAuthorss->contains($l)) {
            $this->doAddBooksByAuthors($l);

            if ($this->booksByAuthorssScheduledForDeletion and $this->booksByAuthorssScheduledForDeletion->contains($l)) {
                $this->booksByAuthorssScheduledForDeletion->remove($this->booksByAuthorssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBooksByAuthors $booksByAuthors The ChildBooksByAuthors object to add.
     */
    protected function doAddBooksByAuthors(ChildBooksByAuthors $booksByAuthors)
    {
        $this->collBooksByAuthorss[]= $booksByAuthors;
        $booksByAuthors->setBooks($this);
    }

    /**
     * @param  ChildBooksByAuthors $booksByAuthors The ChildBooksByAuthors object to remove.
     * @return $this|ChildBooks The current object (for fluent API support)
     */
    public function removeBooksByAuthors(ChildBooksByAuthors $booksByAuthors)
    {
        if ($this->getBooksByAuthorss()->contains($booksByAuthors)) {
            $pos = $this->collBooksByAuthorss->search($booksByAuthors);
            $this->collBooksByAuthorss->remove($pos);
            if (null === $this->booksByAuthorssScheduledForDeletion) {
                $this->booksByAuthorssScheduledForDeletion = clone $this->collBooksByAuthorss;
                $this->booksByAuthorssScheduledForDeletion->clear();
            }
            $this->booksByAuthorssScheduledForDeletion[]= clone $booksByAuthors;
            $booksByAuthors->setBooks(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Books is new, it will return
     * an empty collection; or if this Books has previously
     * been saved, it will retrieve related BooksByAuthorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Books.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooksByAuthors[] List of ChildBooksByAuthors objects
     */
    public function getBooksByAuthorssJoinAuthors(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBooksByAuthorsQuery::create(null, $criteria);
        $query->joinWith('Authors', $joinBehavior);

        return $this->getBooksByAuthorss($query, $con);
    }

    /**
     * Clears out the collBooksByCategoriess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBooksByCategoriess()
     */
    public function clearBooksByCategoriess()
    {
        $this->collBooksByCategoriess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBooksByCategoriess collection loaded partially.
     */
    public function resetPartialBooksByCategoriess($v = true)
    {
        $this->collBooksByCategoriessPartial = $v;
    }

    /**
     * Initializes the collBooksByCategoriess collection.
     *
     * By default this just sets the collBooksByCategoriess collection to an empty array (like clearcollBooksByCategoriess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBooksByCategoriess($overrideExisting = true)
    {
        if (null !== $this->collBooksByCategoriess && !$overrideExisting) {
            return;
        }

        $collectionClassName = BooksByCategoriesTableMap::getTableMap()->getCollectionClassName();

        $this->collBooksByCategoriess = new $collectionClassName;
        $this->collBooksByCategoriess->setModel('\PropelModels\BooksByCategories');
    }

    /**
     * Gets an array of ChildBooksByCategories objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBooks is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBooksByCategories[] List of ChildBooksByCategories objects
     * @throws PropelException
     */
    public function getBooksByCategoriess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBooksByCategoriessPartial && !$this->isNew();
        if (null === $this->collBooksByCategoriess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBooksByCategoriess) {
                // return empty collection
                $this->initBooksByCategoriess();
            } else {
                $collBooksByCategoriess = ChildBooksByCategoriesQuery::create(null, $criteria)
                    ->filterByBooks($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBooksByCategoriessPartial && count($collBooksByCategoriess)) {
                        $this->initBooksByCategoriess(false);

                        foreach ($collBooksByCategoriess as $obj) {
                            if (false == $this->collBooksByCategoriess->contains($obj)) {
                                $this->collBooksByCategoriess->append($obj);
                            }
                        }

                        $this->collBooksByCategoriessPartial = true;
                    }

                    return $collBooksByCategoriess;
                }

                if ($partial && $this->collBooksByCategoriess) {
                    foreach ($this->collBooksByCategoriess as $obj) {
                        if ($obj->isNew()) {
                            $collBooksByCategoriess[] = $obj;
                        }
                    }
                }

                $this->collBooksByCategoriess = $collBooksByCategoriess;
                $this->collBooksByCategoriessPartial = false;
            }
        }

        return $this->collBooksByCategoriess;
    }

    /**
     * Sets a collection of ChildBooksByCategories objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $booksByCategoriess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBooks The current object (for fluent API support)
     */
    public function setBooksByCategoriess(Collection $booksByCategoriess, ConnectionInterface $con = null)
    {
        /** @var ChildBooksByCategories[] $booksByCategoriessToDelete */
        $booksByCategoriessToDelete = $this->getBooksByCategoriess(new Criteria(), $con)->diff($booksByCategoriess);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->booksByCategoriessScheduledForDeletion = clone $booksByCategoriessToDelete;

        foreach ($booksByCategoriessToDelete as $booksByCategoriesRemoved) {
            $booksByCategoriesRemoved->setBooks(null);
        }

        $this->collBooksByCategoriess = null;
        foreach ($booksByCategoriess as $booksByCategories) {
            $this->addBooksByCategories($booksByCategories);
        }

        $this->collBooksByCategoriess = $booksByCategoriess;
        $this->collBooksByCategoriessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BooksByCategories objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BooksByCategories objects.
     * @throws PropelException
     */
    public function countBooksByCategoriess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBooksByCategoriessPartial && !$this->isNew();
        if (null === $this->collBooksByCategoriess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBooksByCategoriess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBooksByCategoriess());
            }

            $query = ChildBooksByCategoriesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBooks($this)
                ->count($con);
        }

        return count($this->collBooksByCategoriess);
    }

    /**
     * Method called to associate a ChildBooksByCategories object to this object
     * through the ChildBooksByCategories foreign key attribute.
     *
     * @param  ChildBooksByCategories $l ChildBooksByCategories
     * @return $this|\PropelModels\Books The current object (for fluent API support)
     */
    public function addBooksByCategories(ChildBooksByCategories $l)
    {
        if ($this->collBooksByCategoriess === null) {
            $this->initBooksByCategoriess();
            $this->collBooksByCategoriessPartial = true;
        }

        if (!$this->collBooksByCategoriess->contains($l)) {
            $this->doAddBooksByCategories($l);

            if ($this->booksByCategoriessScheduledForDeletion and $this->booksByCategoriessScheduledForDeletion->contains($l)) {
                $this->booksByCategoriessScheduledForDeletion->remove($this->booksByCategoriessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBooksByCategories $booksByCategories The ChildBooksByCategories object to add.
     */
    protected function doAddBooksByCategories(ChildBooksByCategories $booksByCategories)
    {
        $this->collBooksByCategoriess[]= $booksByCategories;
        $booksByCategories->setBooks($this);
    }

    /**
     * @param  ChildBooksByCategories $booksByCategories The ChildBooksByCategories object to remove.
     * @return $this|ChildBooks The current object (for fluent API support)
     */
    public function removeBooksByCategories(ChildBooksByCategories $booksByCategories)
    {
        if ($this->getBooksByCategoriess()->contains($booksByCategories)) {
            $pos = $this->collBooksByCategoriess->search($booksByCategories);
            $this->collBooksByCategoriess->remove($pos);
            if (null === $this->booksByCategoriessScheduledForDeletion) {
                $this->booksByCategoriessScheduledForDeletion = clone $this->collBooksByCategoriess;
                $this->booksByCategoriessScheduledForDeletion->clear();
            }
            $this->booksByCategoriessScheduledForDeletion[]= clone $booksByCategories;
            $booksByCategories->setBooks(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Books is new, it will return
     * an empty collection; or if this Books has previously
     * been saved, it will retrieve related BooksByCategoriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Books.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooksByCategories[] List of ChildBooksByCategories objects
     */
    public function getBooksByCategoriessJoinCategories(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBooksByCategoriesQuery::create(null, $criteria);
        $query->joinWith('Categories', $joinBehavior);

        return $this->getBooksByCategoriess($query, $con);
    }

    /**
     * Clears out the collBooksByUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBooksByUsers()
     */
    public function clearBooksByUsers()
    {
        $this->collBooksByUsers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBooksByUsers collection loaded partially.
     */
    public function resetPartialBooksByUsers($v = true)
    {
        $this->collBooksByUsersPartial = $v;
    }

    /**
     * Initializes the collBooksByUsers collection.
     *
     * By default this just sets the collBooksByUsers collection to an empty array (like clearcollBooksByUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBooksByUsers($overrideExisting = true)
    {
        if (null !== $this->collBooksByUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = BooksByUserTableMap::getTableMap()->getCollectionClassName();

        $this->collBooksByUsers = new $collectionClassName;
        $this->collBooksByUsers->setModel('\PropelModels\BooksByUser');
    }

    /**
     * Gets an array of ChildBooksByUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBooks is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBooksByUser[] List of ChildBooksByUser objects
     * @throws PropelException
     */
    public function getBooksByUsers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBooksByUsersPartial && !$this->isNew();
        if (null === $this->collBooksByUsers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBooksByUsers) {
                // return empty collection
                $this->initBooksByUsers();
            } else {
                $collBooksByUsers = ChildBooksByUserQuery::create(null, $criteria)
                    ->filterByBooks($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBooksByUsersPartial && count($collBooksByUsers)) {
                        $this->initBooksByUsers(false);

                        foreach ($collBooksByUsers as $obj) {
                            if (false == $this->collBooksByUsers->contains($obj)) {
                                $this->collBooksByUsers->append($obj);
                            }
                        }

                        $this->collBooksByUsersPartial = true;
                    }

                    return $collBooksByUsers;
                }

                if ($partial && $this->collBooksByUsers) {
                    foreach ($this->collBooksByUsers as $obj) {
                        if ($obj->isNew()) {
                            $collBooksByUsers[] = $obj;
                        }
                    }
                }

                $this->collBooksByUsers = $collBooksByUsers;
                $this->collBooksByUsersPartial = false;
            }
        }

        return $this->collBooksByUsers;
    }

    /**
     * Sets a collection of ChildBooksByUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $booksByUsers A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBooks The current object (for fluent API support)
     */
    public function setBooksByUsers(Collection $booksByUsers, ConnectionInterface $con = null)
    {
        /** @var ChildBooksByUser[] $booksByUsersToDelete */
        $booksByUsersToDelete = $this->getBooksByUsers(new Criteria(), $con)->diff($booksByUsers);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->booksByUsersScheduledForDeletion = clone $booksByUsersToDelete;

        foreach ($booksByUsersToDelete as $booksByUserRemoved) {
            $booksByUserRemoved->setBooks(null);
        }

        $this->collBooksByUsers = null;
        foreach ($booksByUsers as $booksByUser) {
            $this->addBooksByUser($booksByUser);
        }

        $this->collBooksByUsers = $booksByUsers;
        $this->collBooksByUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BooksByUser objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BooksByUser objects.
     * @throws PropelException
     */
    public function countBooksByUsers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBooksByUsersPartial && !$this->isNew();
        if (null === $this->collBooksByUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBooksByUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBooksByUsers());
            }

            $query = ChildBooksByUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBooks($this)
                ->count($con);
        }

        return count($this->collBooksByUsers);
    }

    /**
     * Method called to associate a ChildBooksByUser object to this object
     * through the ChildBooksByUser foreign key attribute.
     *
     * @param  ChildBooksByUser $l ChildBooksByUser
     * @return $this|\PropelModels\Books The current object (for fluent API support)
     */
    public function addBooksByUser(ChildBooksByUser $l)
    {
        if ($this->collBooksByUsers === null) {
            $this->initBooksByUsers();
            $this->collBooksByUsersPartial = true;
        }

        if (!$this->collBooksByUsers->contains($l)) {
            $this->doAddBooksByUser($l);

            if ($this->booksByUsersScheduledForDeletion and $this->booksByUsersScheduledForDeletion->contains($l)) {
                $this->booksByUsersScheduledForDeletion->remove($this->booksByUsersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBooksByUser $booksByUser The ChildBooksByUser object to add.
     */
    protected function doAddBooksByUser(ChildBooksByUser $booksByUser)
    {
        $this->collBooksByUsers[]= $booksByUser;
        $booksByUser->setBooks($this);
    }

    /**
     * @param  ChildBooksByUser $booksByUser The ChildBooksByUser object to remove.
     * @return $this|ChildBooks The current object (for fluent API support)
     */
    public function removeBooksByUser(ChildBooksByUser $booksByUser)
    {
        if ($this->getBooksByUsers()->contains($booksByUser)) {
            $pos = $this->collBooksByUsers->search($booksByUser);
            $this->collBooksByUsers->remove($pos);
            if (null === $this->booksByUsersScheduledForDeletion) {
                $this->booksByUsersScheduledForDeletion = clone $this->collBooksByUsers;
                $this->booksByUsersScheduledForDeletion->clear();
            }
            $this->booksByUsersScheduledForDeletion[]= clone $booksByUser;
            $booksByUser->setBooks(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Books is new, it will return
     * an empty collection; or if this Books has previously
     * been saved, it will retrieve related BooksByUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Books.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooksByUser[] List of ChildBooksByUser objects
     */
    public function getBooksByUsersJoinUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBooksByUserQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getBooksByUsers($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->title = null;
        $this->year = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collBooksByAuthorss) {
                foreach ($this->collBooksByAuthorss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBooksByCategoriess) {
                foreach ($this->collBooksByCategoriess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBooksByUsers) {
                foreach ($this->collBooksByUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBooksByAuthorss = null;
        $this->collBooksByCategoriess = null;
        $this->collBooksByUsers = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BooksTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
