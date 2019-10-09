<?php

namespace PropelModels\Base;

use \Exception;
use \PDO;
use PropelModels\BooksByCategories as ChildBooksByCategories;
use PropelModels\BooksByCategoriesQuery as ChildBooksByCategoriesQuery;
use PropelModels\Map\BooksByCategoriesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'books_by_categories' table.
 *
 *
 *
 * @method     ChildBooksByCategoriesQuery orderByIdBook($order = Criteria::ASC) Order by the id_book column
 * @method     ChildBooksByCategoriesQuery orderByIdCategory($order = Criteria::ASC) Order by the id_category column
 *
 * @method     ChildBooksByCategoriesQuery groupByIdBook() Group by the id_book column
 * @method     ChildBooksByCategoriesQuery groupByIdCategory() Group by the id_category column
 *
 * @method     ChildBooksByCategoriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBooksByCategoriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBooksByCategoriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBooksByCategoriesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBooksByCategoriesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBooksByCategoriesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBooksByCategoriesQuery leftJoinBooks($relationAlias = null) Adds a LEFT JOIN clause to the query using the Books relation
 * @method     ChildBooksByCategoriesQuery rightJoinBooks($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Books relation
 * @method     ChildBooksByCategoriesQuery innerJoinBooks($relationAlias = null) Adds a INNER JOIN clause to the query using the Books relation
 *
 * @method     ChildBooksByCategoriesQuery joinWithBooks($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Books relation
 *
 * @method     ChildBooksByCategoriesQuery leftJoinWithBooks() Adds a LEFT JOIN clause and with to the query using the Books relation
 * @method     ChildBooksByCategoriesQuery rightJoinWithBooks() Adds a RIGHT JOIN clause and with to the query using the Books relation
 * @method     ChildBooksByCategoriesQuery innerJoinWithBooks() Adds a INNER JOIN clause and with to the query using the Books relation
 *
 * @method     ChildBooksByCategoriesQuery leftJoinCategories($relationAlias = null) Adds a LEFT JOIN clause to the query using the Categories relation
 * @method     ChildBooksByCategoriesQuery rightJoinCategories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Categories relation
 * @method     ChildBooksByCategoriesQuery innerJoinCategories($relationAlias = null) Adds a INNER JOIN clause to the query using the Categories relation
 *
 * @method     ChildBooksByCategoriesQuery joinWithCategories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Categories relation
 *
 * @method     ChildBooksByCategoriesQuery leftJoinWithCategories() Adds a LEFT JOIN clause and with to the query using the Categories relation
 * @method     ChildBooksByCategoriesQuery rightJoinWithCategories() Adds a RIGHT JOIN clause and with to the query using the Categories relation
 * @method     ChildBooksByCategoriesQuery innerJoinWithCategories() Adds a INNER JOIN clause and with to the query using the Categories relation
 *
 * @method     \PropelModels\BooksQuery|\PropelModels\CategoriesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBooksByCategories findOne(ConnectionInterface $con = null) Return the first ChildBooksByCategories matching the query
 * @method     ChildBooksByCategories findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBooksByCategories matching the query, or a new ChildBooksByCategories object populated from the query conditions when no match is found
 *
 * @method     ChildBooksByCategories findOneByIdBook(int $id_book) Return the first ChildBooksByCategories filtered by the id_book column
 * @method     ChildBooksByCategories findOneByIdCategory(int $id_category) Return the first ChildBooksByCategories filtered by the id_category column *

 * @method     ChildBooksByCategories requirePk($key, ConnectionInterface $con = null) Return the ChildBooksByCategories by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooksByCategories requireOne(ConnectionInterface $con = null) Return the first ChildBooksByCategories matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBooksByCategories requireOneByIdBook(int $id_book) Return the first ChildBooksByCategories filtered by the id_book column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooksByCategories requireOneByIdCategory(int $id_category) Return the first ChildBooksByCategories filtered by the id_category column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBooksByCategories[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBooksByCategories objects based on current ModelCriteria
 * @method     ChildBooksByCategories[]|ObjectCollection findByIdBook(int $id_book) Return ChildBooksByCategories objects filtered by the id_book column
 * @method     ChildBooksByCategories[]|ObjectCollection findByIdCategory(int $id_category) Return ChildBooksByCategories objects filtered by the id_category column
 * @method     ChildBooksByCategories[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BooksByCategoriesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \PropelModels\Base\BooksByCategoriesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'my_books_library', $modelName = '\\PropelModels\\BooksByCategories', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBooksByCategoriesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBooksByCategoriesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBooksByCategoriesQuery) {
            return $criteria;
        }
        $query = new ChildBooksByCategoriesQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id_book, $id_category] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildBooksByCategories|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BooksByCategoriesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BooksByCategoriesTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildBooksByCategories A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_book, id_category FROM books_by_categories WHERE id_book = :p0 AND id_category = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildBooksByCategories $obj */
            $obj = new ChildBooksByCategories();
            $obj->hydrate($row);
            BooksByCategoriesTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildBooksByCategories|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildBooksByCategoriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(BooksByCategoriesTableMap::COL_ID_BOOK, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(BooksByCategoriesTableMap::COL_ID_CATEGORY, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBooksByCategoriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(BooksByCategoriesTableMap::COL_ID_BOOK, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(BooksByCategoriesTableMap::COL_ID_CATEGORY, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the id_book column
     *
     * Example usage:
     * <code>
     * $query->filterByIdBook(1234); // WHERE id_book = 1234
     * $query->filterByIdBook(array(12, 34)); // WHERE id_book IN (12, 34)
     * $query->filterByIdBook(array('min' => 12)); // WHERE id_book > 12
     * </code>
     *
     * @see       filterByBooks()
     *
     * @param     mixed $idBook The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBooksByCategoriesQuery The current query, for fluid interface
     */
    public function filterByIdBook($idBook = null, $comparison = null)
    {
        if (is_array($idBook)) {
            $useMinMax = false;
            if (isset($idBook['min'])) {
                $this->addUsingAlias(BooksByCategoriesTableMap::COL_ID_BOOK, $idBook['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idBook['max'])) {
                $this->addUsingAlias(BooksByCategoriesTableMap::COL_ID_BOOK, $idBook['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BooksByCategoriesTableMap::COL_ID_BOOK, $idBook, $comparison);
    }

    /**
     * Filter the query on the id_category column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCategory(1234); // WHERE id_category = 1234
     * $query->filterByIdCategory(array(12, 34)); // WHERE id_category IN (12, 34)
     * $query->filterByIdCategory(array('min' => 12)); // WHERE id_category > 12
     * </code>
     *
     * @see       filterByCategories()
     *
     * @param     mixed $idCategory The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBooksByCategoriesQuery The current query, for fluid interface
     */
    public function filterByIdCategory($idCategory = null, $comparison = null)
    {
        if (is_array($idCategory)) {
            $useMinMax = false;
            if (isset($idCategory['min'])) {
                $this->addUsingAlias(BooksByCategoriesTableMap::COL_ID_CATEGORY, $idCategory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCategory['max'])) {
                $this->addUsingAlias(BooksByCategoriesTableMap::COL_ID_CATEGORY, $idCategory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BooksByCategoriesTableMap::COL_ID_CATEGORY, $idCategory, $comparison);
    }

    /**
     * Filter the query by a related \PropelModels\Books object
     *
     * @param \PropelModels\Books|ObjectCollection $books The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBooksByCategoriesQuery The current query, for fluid interface
     */
    public function filterByBooks($books, $comparison = null)
    {
        if ($books instanceof \PropelModels\Books) {
            return $this
                ->addUsingAlias(BooksByCategoriesTableMap::COL_ID_BOOK, $books->getId(), $comparison);
        } elseif ($books instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BooksByCategoriesTableMap::COL_ID_BOOK, $books->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBooks() only accepts arguments of type \PropelModels\Books or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Books relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBooksByCategoriesQuery The current query, for fluid interface
     */
    public function joinBooks($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Books');

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
            $this->addJoinObject($join, 'Books');
        }

        return $this;
    }

    /**
     * Use the Books relation Books object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropelModels\BooksQuery A secondary query class using the current class as primary query
     */
    public function useBooksQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBooks($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Books', '\PropelModels\BooksQuery');
    }

    /**
     * Filter the query by a related \PropelModels\Categories object
     *
     * @param \PropelModels\Categories|ObjectCollection $categories The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBooksByCategoriesQuery The current query, for fluid interface
     */
    public function filterByCategories($categories, $comparison = null)
    {
        if ($categories instanceof \PropelModels\Categories) {
            return $this
                ->addUsingAlias(BooksByCategoriesTableMap::COL_ID_CATEGORY, $categories->getId(), $comparison);
        } elseif ($categories instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BooksByCategoriesTableMap::COL_ID_CATEGORY, $categories->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCategories() only accepts arguments of type \PropelModels\Categories or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Categories relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBooksByCategoriesQuery The current query, for fluid interface
     */
    public function joinCategories($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Categories');

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
            $this->addJoinObject($join, 'Categories');
        }

        return $this;
    }

    /**
     * Use the Categories relation Categories object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropelModels\CategoriesQuery A secondary query class using the current class as primary query
     */
    public function useCategoriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategories($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Categories', '\PropelModels\CategoriesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBooksByCategories $booksByCategories Object to remove from the list of results
     *
     * @return $this|ChildBooksByCategoriesQuery The current query, for fluid interface
     */
    public function prune($booksByCategories = null)
    {
        if ($booksByCategories) {
            $this->addCond('pruneCond0', $this->getAliasedColName(BooksByCategoriesTableMap::COL_ID_BOOK), $booksByCategories->getIdBook(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(BooksByCategoriesTableMap::COL_ID_CATEGORY), $booksByCategories->getIdCategory(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the books_by_categories table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BooksByCategoriesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BooksByCategoriesTableMap::clearInstancePool();
            BooksByCategoriesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BooksByCategoriesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BooksByCategoriesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BooksByCategoriesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BooksByCategoriesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BooksByCategoriesQuery
