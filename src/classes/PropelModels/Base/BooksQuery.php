<?php

namespace PropelModels\Base;

use \Exception;
use \PDO;
use PropelModels\Books as ChildBooks;
use PropelModels\BooksQuery as ChildBooksQuery;
use PropelModels\Map\BooksTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'books' table.
 *
 *
 *
 * @method     ChildBooksQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildBooksQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildBooksQuery orderByYear($order = Criteria::ASC) Order by the year column
 *
 * @method     ChildBooksQuery groupById() Group by the id column
 * @method     ChildBooksQuery groupByTitle() Group by the title column
 * @method     ChildBooksQuery groupByYear() Group by the year column
 *
 * @method     ChildBooksQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBooksQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBooksQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBooksQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBooksQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBooksQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBooksQuery leftJoinBooksByAuthors($relationAlias = null) Adds a LEFT JOIN clause to the query using the BooksByAuthors relation
 * @method     ChildBooksQuery rightJoinBooksByAuthors($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BooksByAuthors relation
 * @method     ChildBooksQuery innerJoinBooksByAuthors($relationAlias = null) Adds a INNER JOIN clause to the query using the BooksByAuthors relation
 *
 * @method     ChildBooksQuery joinWithBooksByAuthors($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BooksByAuthors relation
 *
 * @method     ChildBooksQuery leftJoinWithBooksByAuthors() Adds a LEFT JOIN clause and with to the query using the BooksByAuthors relation
 * @method     ChildBooksQuery rightJoinWithBooksByAuthors() Adds a RIGHT JOIN clause and with to the query using the BooksByAuthors relation
 * @method     ChildBooksQuery innerJoinWithBooksByAuthors() Adds a INNER JOIN clause and with to the query using the BooksByAuthors relation
 *
 * @method     ChildBooksQuery leftJoinBooksByCategories($relationAlias = null) Adds a LEFT JOIN clause to the query using the BooksByCategories relation
 * @method     ChildBooksQuery rightJoinBooksByCategories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BooksByCategories relation
 * @method     ChildBooksQuery innerJoinBooksByCategories($relationAlias = null) Adds a INNER JOIN clause to the query using the BooksByCategories relation
 *
 * @method     ChildBooksQuery joinWithBooksByCategories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BooksByCategories relation
 *
 * @method     ChildBooksQuery leftJoinWithBooksByCategories() Adds a LEFT JOIN clause and with to the query using the BooksByCategories relation
 * @method     ChildBooksQuery rightJoinWithBooksByCategories() Adds a RIGHT JOIN clause and with to the query using the BooksByCategories relation
 * @method     ChildBooksQuery innerJoinWithBooksByCategories() Adds a INNER JOIN clause and with to the query using the BooksByCategories relation
 *
 * @method     ChildBooksQuery leftJoinBooksByUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the BooksByUser relation
 * @method     ChildBooksQuery rightJoinBooksByUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BooksByUser relation
 * @method     ChildBooksQuery innerJoinBooksByUser($relationAlias = null) Adds a INNER JOIN clause to the query using the BooksByUser relation
 *
 * @method     ChildBooksQuery joinWithBooksByUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BooksByUser relation
 *
 * @method     ChildBooksQuery leftJoinWithBooksByUser() Adds a LEFT JOIN clause and with to the query using the BooksByUser relation
 * @method     ChildBooksQuery rightJoinWithBooksByUser() Adds a RIGHT JOIN clause and with to the query using the BooksByUser relation
 * @method     ChildBooksQuery innerJoinWithBooksByUser() Adds a INNER JOIN clause and with to the query using the BooksByUser relation
 *
 * @method     \PropelModels\BooksByAuthorsQuery|\PropelModels\BooksByCategoriesQuery|\PropelModels\BooksByUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBooks findOne(ConnectionInterface $con = null) Return the first ChildBooks matching the query
 * @method     ChildBooks findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBooks matching the query, or a new ChildBooks object populated from the query conditions when no match is found
 *
 * @method     ChildBooks findOneById(int $id) Return the first ChildBooks filtered by the id column
 * @method     ChildBooks findOneByTitle(string $title) Return the first ChildBooks filtered by the title column
 * @method     ChildBooks findOneByYear(int $year) Return the first ChildBooks filtered by the year column *

 * @method     ChildBooks requirePk($key, ConnectionInterface $con = null) Return the ChildBooks by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooks requireOne(ConnectionInterface $con = null) Return the first ChildBooks matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBooks requireOneById(int $id) Return the first ChildBooks filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooks requireOneByTitle(string $title) Return the first ChildBooks filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooks requireOneByYear(int $year) Return the first ChildBooks filtered by the year column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBooks[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBooks objects based on current ModelCriteria
 * @method     ChildBooks[]|ObjectCollection findById(int $id) Return ChildBooks objects filtered by the id column
 * @method     ChildBooks[]|ObjectCollection findByTitle(string $title) Return ChildBooks objects filtered by the title column
 * @method     ChildBooks[]|ObjectCollection findByYear(int $year) Return ChildBooks objects filtered by the year column
 * @method     ChildBooks[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BooksQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \PropelModels\Base\BooksQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'my_books_library', $modelName = '\\PropelModels\\Books', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBooksQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBooksQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBooksQuery) {
            return $criteria;
        }
        $query = new ChildBooksQuery();
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
     * @return ChildBooks|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BooksTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BooksTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBooks A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, title, year FROM books WHERE id = :p0';
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
            /** @var ChildBooks $obj */
            $obj = new ChildBooks();
            $obj->hydrate($row);
            BooksTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBooks|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBooksQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BooksTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBooksQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BooksTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildBooksQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(BooksTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(BooksTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BooksTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBooksQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BooksTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the year column
     *
     * Example usage:
     * <code>
     * $query->filterByYear(1234); // WHERE year = 1234
     * $query->filterByYear(array(12, 34)); // WHERE year IN (12, 34)
     * $query->filterByYear(array('min' => 12)); // WHERE year > 12
     * </code>
     *
     * @param     mixed $year The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBooksQuery The current query, for fluid interface
     */
    public function filterByYear($year = null, $comparison = null)
    {
        if (is_array($year)) {
            $useMinMax = false;
            if (isset($year['min'])) {
                $this->addUsingAlias(BooksTableMap::COL_YEAR, $year['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($year['max'])) {
                $this->addUsingAlias(BooksTableMap::COL_YEAR, $year['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BooksTableMap::COL_YEAR, $year, $comparison);
    }

    /**
     * Filter the query by a related \PropelModels\BooksByAuthors object
     *
     * @param \PropelModels\BooksByAuthors|ObjectCollection $booksByAuthors the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBooksQuery The current query, for fluid interface
     */
    public function filterByBooksByAuthors($booksByAuthors, $comparison = null)
    {
        if ($booksByAuthors instanceof \PropelModels\BooksByAuthors) {
            return $this
                ->addUsingAlias(BooksTableMap::COL_ID, $booksByAuthors->getIdBook(), $comparison);
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
     * @return $this|ChildBooksQuery The current query, for fluid interface
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
     * Filter the query by a related \PropelModels\BooksByCategories object
     *
     * @param \PropelModels\BooksByCategories|ObjectCollection $booksByCategories the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBooksQuery The current query, for fluid interface
     */
    public function filterByBooksByCategories($booksByCategories, $comparison = null)
    {
        if ($booksByCategories instanceof \PropelModels\BooksByCategories) {
            return $this
                ->addUsingAlias(BooksTableMap::COL_ID, $booksByCategories->getIdBook(), $comparison);
        } elseif ($booksByCategories instanceof ObjectCollection) {
            return $this
                ->useBooksByCategoriesQuery()
                ->filterByPrimaryKeys($booksByCategories->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBooksByCategories() only accepts arguments of type \PropelModels\BooksByCategories or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BooksByCategories relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBooksQuery The current query, for fluid interface
     */
    public function joinBooksByCategories($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BooksByCategories');

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
            $this->addJoinObject($join, 'BooksByCategories');
        }

        return $this;
    }

    /**
     * Use the BooksByCategories relation BooksByCategories object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropelModels\BooksByCategoriesQuery A secondary query class using the current class as primary query
     */
    public function useBooksByCategoriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBooksByCategories($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BooksByCategories', '\PropelModels\BooksByCategoriesQuery');
    }

    /**
     * Filter the query by a related \PropelModels\BooksByUser object
     *
     * @param \PropelModels\BooksByUser|ObjectCollection $booksByUser the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBooksQuery The current query, for fluid interface
     */
    public function filterByBooksByUser($booksByUser, $comparison = null)
    {
        if ($booksByUser instanceof \PropelModels\BooksByUser) {
            return $this
                ->addUsingAlias(BooksTableMap::COL_ID, $booksByUser->getIdBook(), $comparison);
        } elseif ($booksByUser instanceof ObjectCollection) {
            return $this
                ->useBooksByUserQuery()
                ->filterByPrimaryKeys($booksByUser->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBooksByUser() only accepts arguments of type \PropelModels\BooksByUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BooksByUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBooksQuery The current query, for fluid interface
     */
    public function joinBooksByUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BooksByUser');

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
            $this->addJoinObject($join, 'BooksByUser');
        }

        return $this;
    }

    /**
     * Use the BooksByUser relation BooksByUser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropelModels\BooksByUserQuery A secondary query class using the current class as primary query
     */
    public function useBooksByUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBooksByUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BooksByUser', '\PropelModels\BooksByUserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBooks $books Object to remove from the list of results
     *
     * @return $this|ChildBooksQuery The current query, for fluid interface
     */
    public function prune($books = null)
    {
        if ($books) {
            $this->addUsingAlias(BooksTableMap::COL_ID, $books->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the books table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BooksTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BooksTableMap::clearInstancePool();
            BooksTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BooksTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BooksTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BooksTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BooksTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BooksQuery
