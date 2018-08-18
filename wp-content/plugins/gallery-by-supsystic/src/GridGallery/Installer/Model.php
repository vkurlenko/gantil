<?php

class GridGallery_Installer_Model extends GridGallery_Core_BaseModel
{
    /**
     * Cheks whether the specified table exists.
     * @param  string $tableName Table name.
     * @return bool
     */
    public function tableExists($tableName)
    {
        $prefix = $this->db->prefix;
        $table = str_replace('{prefix}', $prefix, $tableName);

        $query = 'SHOW TABLES LIKE \'' . $table . '\'';

        $result = $this->db->get_results($query);

        return (count($result) > 0 ? true : false);
    }

    /**
     * Replace {prefix} with the current database prefix.
     * @param  string $table Table name or query.
     * @return string
     */
    public function prefix($table)
    {
        return str_replace('{prefix}', $this->db->prefix, $table);
    }

    /**
     * Install plugin.
     * @param  array $queries An array of the queries.
     * @return bool
     */
    public function install($queries)
    {
        if (!is_array($queries)) {
            return false;
        }

        foreach ($queries as $table => $query) {
			$this->delta($this->prefix($query));
        }

        return true;
    }

    /**
     * Uninstall plugin.
     * @param  array $queries An array of the queries.
     * @return bool
     */
    public function drop($queries)
    {
        if (!is_array($queries)) {
            return false;
        }

        foreach ($queries as $table => $query) {
            $this->dropTable($table);
        }

        return true;
    }

    /**
     * Updates the database.
     * @param  array $queries An array of the queries.
     */
    public function update($queries)
    {
        foreach ($queries as $table => $query) {
            if (!$this->tableExists($table)) {
				$this->delta($this->prefix($query));
            }
        }
    }

    protected function dropTable($table)
    {
        $importantTable = array(
            $this->prefix('{prefix}gg_photos'),
            $this->prefix('{prefix}gg_galleries_resources'),
            $this->prefix('{prefix}gg_settings_sets'),
            $this->prefix('{prefix}gg_galleries'),
        );
        if(!in_array($this->prefix($table), $importantTable)){
            $query = 'DROP TABLE IF EXISTS ' . $this->prefix($table);
            $this->db->query($query);
        }
    }
}
