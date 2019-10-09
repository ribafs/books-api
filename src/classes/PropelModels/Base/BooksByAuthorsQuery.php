<?php

namespace PropelModels\Base;

use \Exception;
use \PDO;
use PropelModels\BooksByAuthors as ChildBooksByAuthors;
use PropelModels\BooksByAuthorsQuery as ChildBooksByAuthorsQuery;
use PropelModels\Map\BooksByAuthorsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'books_by_authors' table.
 *
 *
 *
 * @method     ChildBooksByAuthorsQuery orderByIdBook($order = Criteria::ASC) Order by the id_book column
 * @method     ChildBooksByAuthorsQuery orderByIdAuthor($order = Criteria::ASC) Order by the id_author column
 *
 * @method     ChildBooksByAuthorsQuery groupByIdBook() Group by the id_book column
 * @method     ChildBooksByAuthorsQuery groupByIdAuthor() Group by the id_author column
 *
 * @method     ChildBooksByAuthorsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBooksByAuthorsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBooksByAuthorsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBooksByAuthorsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBooksByAuthorsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBooksByAuthorsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBooksByAuthorsQuery leftJoinBooks($relationAlias = null) Adds a LEFT JOIN clause to the query using the Books relation
 * @method     ChildBooksByAuthorsQuery rightJoinBooks($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Books relation
 * @method     ChildBooksByAuthorsQuery innerJoinBooks($relationAlias = null) Adds a INNER JOIN clause to the query using the Books relation
 *
 * @method     ChildBooksByAuthorsQuery joinWithBooks($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Books relation
 *
 * @method     ChildBooksByAuthorsQuery leftJoinWithBooks() Adds a LEFT JOIN clause and with to the query using the Books relation
 * @method     ChildBooksByAuthorsQuery rightJoinWithBooks() Adds a RIGHT JOIN clause and with to the query using the Books relation
 * @method     ChildBooksByAuthorsQuery innerJoinWithBooks() Adds a INNER JOIN clause and with to the query using the Books relation
 *
 * @method     ChildBooksByAuthorsQuery leftJoinAuthors($relationAlias = null) Adds a LEFT JOIN clause to the query using the Authors relation
 * @method     ChildBooksByAuthorsQuery rightJoinAuthors($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Authors relation
 * @method     ChildBooksByAuthorsQuery innerJoinAuthors($relationAlias = null) Adds a INNER JOIN clause to the query using the Authors relation
 *
 * @method     ChildBooksByAuthorsQuery joinWithAuthors($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Authors relation
 *
 * @method     ChildBooksByAuthorsQuery leftJoinWithAuthors() Adds a LEFT JOIN clause and with to the query using the Authors relation
 * @method     ChildBooksByAuthorsQuery rightJoinWithAuthors() Adds a RIGHT JOIN clause and with to the query using the Authors relation
 * @method     ChildBooksByAuthorsQuery innerJoinWithAuthors() Adds a INNER JOIN clause and with to the query using the Authors relation
 *
 * @method     \PropelModels\BooksQuery|\PropelModels\AuthorsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBooksByAuthors findOne(ConnectionInterface $con = null) Return the first ChildBooksByAuthors matching the query
 * @method     ChildBooksByAuthors findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBooksByAuthors matching the query, or a new ChildBooksByAuthors object populated from the query conditions when no match is found
 *
 * @method     ChildBooksByAuthors findOneByIdBook(int $id_book) Return the first ChildBooksByAuthors filtered by the id_book column
 * @method     ChildBooksByAuthors findOneByIdAuthor(int $id_author) Return the first ChildBooksByAuthors filtered by the id_author column *

 * @method     ChildBooksByAuthors requirePk($key, ConnectionInterface $con = null) Return the ChildBooksByAuthors by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooksByAuthors requireOne(ConnectionInterface $con = null) Return the first ChildBooksByAuthors matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBooksByAuthors requireOneByIdBook(int $id_book) Return the first ChildBooksByAuthors filtered by the id_book column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooksByAuthors requireOneByIdAuthor(int $id_author) Return the first ChildBooksByAuthors filtered by the id_author column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBooksByAuthors[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBooksByAuthors objects based on current ModelCriteria
 * @method     ChildBooksByAuthors[]|ObjectCollection findByIdBook(int $id_book) Return ChildBooksByAuthors objects filtered by the id_book column
 * @method     ChildBooksByAuthors[]|ObjectCollection findByIdAuthor(int $id_author) Return ChildBooksByAuthors objects filtered by the id_author column
 * @method     ChildBooksByAuthors[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BooksByAuthorsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \PropelModels\Base\BooksByAuthorsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'my_books_library', $modelName = '\\PropelModels\\BooksByAuthors', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBooksByAuthorsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBooksByAuthorsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBooksByAuthorsQuery) {
            return $criteria;
        }
        $query = new ChildBooksByAuthorsQuery();
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
     * @param array[$id_book, $id_author] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildBooksByAuthors|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BooksByAuthorsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BooksByAuthorsTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildBooksByAuthors A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_book, id_author FROM books_by_authors WHERE id_book = :p0 AND id_author = :p1';
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
            /** @var ChildBooksByAuthors $obj */
            $obj = new ChildBooksByAuthors();
            $obj->hydrate($row);
            BooksByAuthorsTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildBooksByAuthors|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBooksByAuthorsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(BooksByAuthorsTableMap::COL_ID_BOOK, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(BooksByAuthorsTableMap::COL_ID_AUTHOR, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBooksByAuthorsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(BooksByAuthorsTableMap::COL_ID_BOOK, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(BooksByAuthorsTableMap::COL_ID_AUTHOR, $key[1], Criteria::EQUAL);
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
     * @return $this|ChildBooksByAuthorsQuery The current query, for fluid interface
     */
    public function filterByIdBook($idBook = null, $comparison = null)
    {
        if (is_array($idBook)) {
            $useMinMax = false;
            if (isset($idBook['min'])) {
                $this->addUsingAlias(BooksByAuthorsTableMap::COL_ID_BOOK, $idBook['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idBook['max'])) {
                $this->addUsingAlias(BooksByAuthorsTableMap::COL_ID_BOOK, $idBook['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BooksByAuthorsTableMap::COL_ID_BOOK, $idBook, $comparison);
    }

    /**
     * Filter the query on the id_author column
     *
     * Example usage:
     * <code>
     * $query->filterByIdAuthor(1234); // WHERE id_author = 1234
     * $query->filterByIdAuthor(array(12, 34)); // WHERE id_author IN (12, 34)
     * $query->filterByIdAuthor(array('min' => 12)); // WHERE id_author > 12
     * </code>
     *
     * @see       filterByAuthors()
     *
     * @param     mixed $idAuthor The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBooksByAuthorsQuery The current query, for fluid interface
     */
    public function filterByIdAuthor($idAuthor = null, $comparison = null)
    {
        if (is_array($idAuthor)) {
            $useMinMax = false;
            if (isset($idAuthor['min'])) {
                $this->addUsingAlias(BooksByAuthorsTableMap::COL_ID_AUTHOR, $idAuthor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAuthor['max'])) {
                $this->addUsingAlias(BooksByAuthorsTableMap::COL_ID_AUTHOR, $idAuthor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BooksByAuthorsTableMap::COL_ID_AUTHOR, $idAuthor, $comparison);
    }

    /**
     * Filter the query by a related \PropelModels\Books object
     *
     * @param \PropelModels\Books|ObjectCollection $books The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBooksByAuthorsQuery The current query, for fluid interface
     */
    public function filterByBooks($books, $comparison = null)
    {
        if ($books instanceof \PropelModels\Books) {
            return $this
                ->addUsingAlias(BooksByAuthorsTableMap::COL_ID_BOOK, $books->getId(), $comparison);
        } elseif ($books instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BooksByAuthorsTableMap::COL_ID_BOOK, $books->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildBooksByAuthorsQuery The current query, for fluid interface
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
     * Filter the query by a related \PropelModels\Authors object
     *
     * @param \PropelModels\Authors|ObjectCollection $authors The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBooksByAuthorsQuery The current query, for fluid interface
     */
    public function filterByAuthors($authors, $comparison = null)
    {
        if ($authors instanceof \PropelModels\Authors) {
            return $this
                ->addUsingAlias(BooksByAuthorsTableMap::COL_ID_AUTHOR, $authors->getId(), $comparison);
        } elseif ($authors instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BooksByAuthorsTableMap::COL_ID_AUTHOR, $authors->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByAuthors() only accepts arguments of type \PropelModels\Authors or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Authors relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBooksByAuthorsQuery The current query, for fluid interface
     */
    public function joinAuthors($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Authors');

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
            $this->addJoinObject($join, 'Authors');
        }

        return $this;
    }

    /**
     * Use the Authors relation Authors object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropelModels\AuthorsQuery A secondary query class using the current class as primary query
     */
    public function useAuthorsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAuthors($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Authors', '\PropelModels\AuthorsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBooksByAuthors $booksByAuthors Object to remove from the list of results
     *
     * @return $this|ChildBooksByAuthorsQuery The current query, for fluid interface
     */
    public function prune($booksByAuthors = null)
    {
        if ($booksByAuthors) {
            $this->addCond('pruneCond0', $this->getAliasedColName(BooksByAuthorsTableMap::COL_ID_BOOK), $booksByAuthors->getIdBook(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(BooksByAuthorsTableMap::COL_ID_AUTHOR), $booksByAuthors->getIdAuthor(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the books_by_authors table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BooksByAuthorsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BooksByAuthorsTableMap::clearInstancePool();
            BooksByAuthorsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BooksByAuthorsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BooksByAuthorsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BooksByAuthorsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BooksByAuthorsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BooksByAuthorsQuery
