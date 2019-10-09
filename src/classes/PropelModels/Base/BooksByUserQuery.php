<?php

namespace PropelModels\Base;

use \Exception;
use \PDO;
use PropelModels\BooksByUser as ChildBooksByUser;
use PropelModels\BooksByUserQuery as ChildBooksByUserQuery;
use PropelModels\Map\BooksByUserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'books_by_user' table.
 *
 *
 *
 * @method     ChildBooksByUserQuery orderByIdBook($order = Criteria::ASC) Order by the id_book column
 * @method     ChildBooksByUserQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 *
 * @method     ChildBooksByUserQuery groupByIdBook() Group by the id_book column
 * @method     ChildBooksByUserQuery groupByIdUser() Group by the id_user column
 *
 * @method     ChildBooksByUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBooksByUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBooksByUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBooksByUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBooksByUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBooksByUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBooksByUserQuery leftJoinBooks($relationAlias = null) Adds a LEFT JOIN clause to the query using the Books relation
 * @method     ChildBooksByUserQuery rightJoinBooks($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Books relation
 * @method     ChildBooksByUserQuery innerJoinBooks($relationAlias = null) Adds a INNER JOIN clause to the query using the Books relation
 *
 * @method     ChildBooksByUserQuery joinWithBooks($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Books relation
 *
 * @method     ChildBooksByUserQuery leftJoinWithBooks() Adds a LEFT JOIN clause and with to the query using the Books relation
 * @method     ChildBooksByUserQuery rightJoinWithBooks() Adds a RIGHT JOIN clause and with to the query using the Books relation
 * @method     ChildBooksByUserQuery innerJoinWithBooks() Adds a INNER JOIN clause and with to the query using the Books relation
 *
 * @method     ChildBooksByUserQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildBooksByUserQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildBooksByUserQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildBooksByUserQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildBooksByUserQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildBooksByUserQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildBooksByUserQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     \PropelModels\BooksQuery|\PropelModels\UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBooksByUser findOne(ConnectionInterface $con = null) Return the first ChildBooksByUser matching the query
 * @method     ChildBooksByUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBooksByUser matching the query, or a new ChildBooksByUser object populated from the query conditions when no match is found
 *
 * @method     ChildBooksByUser findOneByIdBook(int $id_book) Return the first ChildBooksByUser filtered by the id_book column
 * @method     ChildBooksByUser findOneByIdUser(int $id_user) Return the first ChildBooksByUser filtered by the id_user column *

 * @method     ChildBooksByUser requirePk($key, ConnectionInterface $con = null) Return the ChildBooksByUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooksByUser requireOne(ConnectionInterface $con = null) Return the first ChildBooksByUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBooksByUser requireOneByIdBook(int $id_book) Return the first ChildBooksByUser filtered by the id_book column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooksByUser requireOneByIdUser(int $id_user) Return the first ChildBooksByUser filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBooksByUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBooksByUser objects based on current ModelCriteria
 * @method     ChildBooksByUser[]|ObjectCollection findByIdBook(int $id_book) Return ChildBooksByUser objects filtered by the id_book column
 * @method     ChildBooksByUser[]|ObjectCollection findByIdUser(int $id_user) Return ChildBooksByUser objects filtered by the id_user column
 * @method     ChildBooksByUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BooksByUserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \PropelModels\Base\BooksByUserQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'my_books_library', $modelName = '\\PropelModels\\BooksByUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBooksByUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBooksByUserQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBooksByUserQuery) {
            return $criteria;
        }
        $query = new ChildBooksByUserQuery();
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
     * @param array[$id_book, $id_user] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildBooksByUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BooksByUserTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BooksByUserTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildBooksByUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_book, id_user FROM books_by_user WHERE id_book = :p0 AND id_user = :p1';
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
            /** @var ChildBooksByUser $obj */
            $obj = new ChildBooksByUser();
            $obj->hydrate($row);
            BooksByUserTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildBooksByUser|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBooksByUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(BooksByUserTableMap::COL_ID_BOOK, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(BooksByUserTableMap::COL_ID_USER, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBooksByUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(BooksByUserTableMap::COL_ID_BOOK, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(BooksByUserTableMap::COL_ID_USER, $key[1], Criteria::EQUAL);
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
     * @return $this|ChildBooksByUserQuery The current query, for fluid interface
     */
    public function filterByIdBook($idBook = null, $comparison = null)
    {
        if (is_array($idBook)) {
            $useMinMax = false;
            if (isset($idBook['min'])) {
                $this->addUsingAlias(BooksByUserTableMap::COL_ID_BOOK, $idBook['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idBook['max'])) {
                $this->addUsingAlias(BooksByUserTableMap::COL_ID_BOOK, $idBook['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BooksByUserTableMap::COL_ID_BOOK, $idBook, $comparison);
    }

    /**
     * Filter the query on the id_user column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUser(1234); // WHERE id_user = 1234
     * $query->filterByIdUser(array(12, 34)); // WHERE id_user IN (12, 34)
     * $query->filterByIdUser(array('min' => 12)); // WHERE id_user > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $idUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBooksByUserQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(BooksByUserTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(BooksByUserTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BooksByUserTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query by a related \PropelModels\Books object
     *
     * @param \PropelModels\Books|ObjectCollection $books The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBooksByUserQuery The current query, for fluid interface
     */
    public function filterByBooks($books, $comparison = null)
    {
        if ($books instanceof \PropelModels\Books) {
            return $this
                ->addUsingAlias(BooksByUserTableMap::COL_ID_BOOK, $books->getId(), $comparison);
        } elseif ($books instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BooksByUserTableMap::COL_ID_BOOK, $books->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildBooksByUserQuery The current query, for fluid interface
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
     * Filter the query by a related \PropelModels\User object
     *
     * @param \PropelModels\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBooksByUserQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \PropelModels\User) {
            return $this
                ->addUsingAlias(BooksByUserTableMap::COL_ID_USER, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BooksByUserTableMap::COL_ID_USER, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \PropelModels\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBooksByUserQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropelModels\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\PropelModels\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBooksByUser $booksByUser Object to remove from the list of results
     *
     * @return $this|ChildBooksByUserQuery The current query, for fluid interface
     */
    public function prune($booksByUser = null)
    {
        if ($booksByUser) {
            $this->addCond('pruneCond0', $this->getAliasedColName(BooksByUserTableMap::COL_ID_BOOK), $booksByUser->getIdBook(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(BooksByUserTableMap::COL_ID_USER), $booksByUser->getIdUser(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the books_by_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BooksByUserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BooksByUserTableMap::clearInstancePool();
            BooksByUserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BooksByUserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BooksByUserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BooksByUserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BooksByUserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BooksByUserQuery
