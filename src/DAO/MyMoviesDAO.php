<?php


namespace MyMovies\DAO;


use MyMovies\Domain\MyMovies;


class MyMoviesDAO extends DAO

{
 public function find($id) {

        $sql = "select * from movie where art_id=?";

        $row = $this->getDb()->fetchAssoc($sql, array($id));


        if ($row)

            return $this->buildDomainObject($row);

        else

            throw new \Exception("No MyMovies matching id " . $id);

    }
    /**

     * Return a list of all MyMoviess, sorted by date (most recent first).

     *

     * @return array A list of all MyMoviess.

     */

    public function findAll() {

        $sql = "select * from movie order by art_id desc";

        $result = $this->getDb()->fetchAll($sql);


        // Convert query result to an array of domain objects

        $MyMoviess = array();

        foreach ($result as $row) {

            $MyMoviesId = $row['cat_id'];

            $MyMoviess[$cat_id] = $this->buildDomainObject($row);

        }

        return $MyMoviess;

    }


    /**

     * Creates an MyMovies object based on a DB row.

     *

     * @param array $row The DB row containing MyMovies data.

     * @return \MyMovies\Domain\MyMovies

     */

    protected function buildDomainObject($row) {

        $MyMovies = new MyMovies();

        $MyMovies->setId($row['Cat_id']);

        $MyMovies->setTitle($row['Cat_title']);

        $MyMovies->setContent($row['Cat_content']);

        return $MyMovies;

    }

}
