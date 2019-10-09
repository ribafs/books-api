<?php

namespace PropelModels\Base;

use \Exception;
use \PDO;
use PropelModels\Authors as ChildAuthors;
use PropelModels\AuthorsQuery as ChildAuthorsQuery;
use PropelModels\Map\AuthorsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'authors' table.
 *
 *
 *
 * @method     ChildAuthorsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildAuthorsQuery orderByFirstname($order = Criteria::ASC) Order by the firstname column
 * @method     ChildAuthorsQuery orderByLastname($order = Criteria::ASC) Order by the lastname column
 *
 * @method     ChildAuthorsQuery groupById() Group by the id column
 * @method     ChildAuthorsQuery groupByFirstname() Group by the firstname column
 * @method     ChildAuthorsQuery groupByLastname() Group by the lastname column
 *
 * @method     ChildAuthorsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAuthorsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAuthorsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAuthorsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAuthorsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAuthorsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAuthorsQuery leftJoinBooksByAuthors($relationAlias = null) Adds a LEFT JOIN clause to the query using the BooksByAuthors relation
 * @method     ChildAuthorsQuery rightJoinBooksByAuthors($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BooksByAuthors relation
 * @method     ChildAuthorsQuery innerJoinBooksByAuthors($relationAlias = null) Adds a INNER JOIN clause to the query using the BooksByAuthors relation
 *
 * @method     ChildAuthorsQuery joinWithBooksByAuthors($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BooksByAuthors relation
 *
 * @method     ChildAuthorsQuery leftJoinWithBooksByAuthors() Adds a LEFT JOIN clause and with to the query using the BooksByAuthors relation
 * @method     ChildAuthorsQuery rightJoinWithBooksByAuthors() Adds a RIGHT JOIN clause and with to the query using the BooksByAuthors relation
 * @method     ChildAuthorsQuery innerJoinWithBooksByAuthors() Adds a INNER JOIN clause and with to the query using the BooksByAuthors relation
 *
 * @method     \PropelModels\BooksByAuthorsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAuthors findOne(ConnectionInterface $con = null) Return the first ChildAuthors matching the query
 * @method     ChildAuthors findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAuthors matching the query, or a new ChildAuthors object populated from the query conditions when no match is found
 *
 * @method     ChildAuthors findOneById(int $id) Return the first ChildAuthors filtered by the id column
 * @method     ChildAuthors findOneByFirstname(string $firstname) Return the first ChildAuthors filtered by the firstname column
 * @method     ChildAuthors findOneByLastname(string $lastname) Return the first ChildAuthors filtered by the lastname column *

 * @method     ChildAuthors requirePk($key, ConnectionInterface $con = null) Return the ChildAuthors by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthors requireOne(ConnectionInterface $con = null) Return the first ChildAuthors matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAuthors requireOneById(int $id) Return the first ChildAuthors filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthors requireOneByFirstname(string $firstname) Return the first ChildAuthors filtered by the firstname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthors requireOneByLastname(string $lastname) Return the first ChildAuthors filtered by the lastname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAuthors[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAuthors objects based on current ModelCriteria
 * @method     ChildAuthors[]|ObjectCollection findById(int $id) Return ChildAuthors objects filtered by the id column
 * @method     ChildAuthors[]|ObjectCollection findByFirstname(string $firstname) Return ChildAuthors objects filtered by the firstname column
 * @method     ChildAuthors[]|ObjectCollection findByLastname(string $lastname) Return ChildAuthors objects filtered by the lastname column
 * @method     ChildAuthors[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AuthorsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \PropelModels\Base\AuthorsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'my_books_library', $modelName = '\\PropelModels\\Authors', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAuthorsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAuthorsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAuthorsQuery) {
            return $criteria;
        }
        $query = new ChildAuthorsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildAuthors|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AuthorsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AuthorsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAuthors A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, firstname, lastname FROM authors WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildAuthors $obj */
            $obj = new ChildAuthors();
            $obj->hydrate($row);
            AuthorsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildAuthors|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildAuthorsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AuthorsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAuthorsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AuthorsTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuthorsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(AuthorsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AuthorsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuthorsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the firstname column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstname('fooValue');   // WHERE firstname = 'fooValue'
     * $query->filterByFirstname('%fooValue%', Criteria::LIKE); // WHERE firstname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuthorsQuery The current query, for fluid interface
     */
    public function filterByFirstname($firstname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuthorsTableMap::COL_FIRSTNAME, $firstname, $comparison);
    }

    /**
     * Filter the query on the lastname column
     *
     * Example usage:
     * <code>
     * $query->filterByLastname('fooValue');   // WHERE lastname = 'fooValue'
     * $query->filterByLastname('%fooValue%', Criteria::LIKE); // WHERE lastname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuthorsQuery The current query, for fluid interface
     */
    public function filterByLastname($lastname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuthorsTableMap::COL_LASTNAME, $lastname, $comparison);
    }

    /**
     * Filter the query by a related \PropelModels\BooksByAuthors object
     *
     * @param \PropelModels\BooksByAuthors|ObjectCollection $booksByAuthors the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAuthorsQuery The current query, for fluid interface
     */
    public function filterByBooksByAuthors($booksByAuthors, $comparison = null)
    {
        if ($booksByAuthors instanceof \PropelModels\BooksByAuthors) {
            return $this
                ->addUsingAlias(AuthorsTableMap::COL_ID, $booksByAuthors->getIdAuthor(), $comparison);
        } elseif ($booksByAuthors instanceof ObjectCollection) {
            return $this
                ->useBooksByAuthorsQuery()
                ->filterByPrimaryKeys($booksByAuthors->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBooksByAuthors() only accepts arguments of type \PropelModels\BooksByAuthors or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BooksByAuthors relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAuthorsQuery The current query, for fluid interface
     */
    public function joinBooksByAuthors($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BooksByAuthors');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'BooksByAuthors');
        }

        return $this;
    }

    /**
     * Use the BooksByAuthors relation BooksByAuthors object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropelModels\BooksByAuthorsQuery A secondary query class using the current class as primary query
     */
    public function useBooksByAuthorsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBooksByAuthors($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BooksByAuthors', '\PropelModels\BooksByAuthorsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAuthors $authors Object to remove from the list of results
     *
     * @return $this|ChildAuthorsQuery The current query, for fluid interface
     */
    public function prune($authors = null)
    {
        if ($authors) {
            $this->addUsingAlias(AuthorsTableMap::COL_ID, $authors->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the authors table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AuthorsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AuthorsTableMap::clearInstancePool();
            AuthorsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AuthorsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AuthorsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AuthorsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AuthorsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AuthorsQuery
