<?php defined('BASEPATH') or exit('No direct script access allowed');

/* ----------------------------------------------------------------------------
 * Easy!Appointments - Open Source Web Scheduler
 *
 * @package     EasyAppointments
 * @author      A.Tselegidis <alextselegidis@gmail.com>
 * @copyright   Copyright (c) 2013 - 2020, Alex Tselegidis
 * @license     https://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        https://easyappointments.org
 * @since       v1.4.0
 * ---------------------------------------------------------------------------- */

/**
 * Easy!Appointments model.
 *
 * @property EA_Benchmark $benchmark
 * @property EA_Cache $cache
 * @property EA_Calendar $calendar
 * @property EA_Config $config
 * @property EA_DB_forge $dbforge
 * @property EA_DB_query_builder $db
 * @property EA_DB_utility $dbutil
 * @property EA_Email $email
 * @property EA_Encrypt $encrypt
 * @property EA_Encryption $encryption
 * @property EA_Exceptions $exceptions
 * @property EA_Hooks $hooks
 * @property EA_Input $input
 * @property EA_Lang $lang
 * @property EA_Loader $load
 * @property EA_Log $log
 * @property EA_Migration $migration
 * @property EA_Output $output
 * @property EA_Profiler $profiler
 * @property EA_Router $router
 * @property EA_Security $security
 * @property EA_Session $session
 * @property EA_Upload $upload
 * @property EA_URI $uri
 */
class EA_Model extends CI_Model {
    /**
     * @var array
     */
    protected $casts = [];

    /**
     * EA_Model constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get a specific field value from the database.
     *
     * @param string $field Name of the value to be returned.
     * @param int $record_id Record ID.
     *
     * @return string Returns the selected record value from the database.
     *
     * @throws InvalidArgumentException
     *
     * @deprecated Since 1.5
     */
    public function get_value(string $field, int $record_id): string
    {
        return $this->value($field, $record_id);
    }

    /**
     * Get a specific record from the database.
     *
     * @param int $record_id The ID of the record to be returned.
     *
     * @return array Returns an array with the record data.
     *
     * @throws InvalidArgumentException
     *
     * @deprecated Since 1.5
     */
    public function get_row(int $record_id): array
    {
        return $this->find($record_id);
    }

    /**
     * Get all records that match the provided criteria.
     *
     * @param mixed|null $where
     * @param int|null $limit
     * @param int|null $offset
     * @param string|null $order_by
     *
     * @return array Returns an array of records.
     */
    public function get_batch($where = NULL, int $limit = NULL, int $offset = NULL, string $order_by = NULL): array
    {
        return $this->get($where, $limit, $offset, $order_by);
    }

    /**
     * Save (insert or update) a record.
     *
     * @param array $record Associative array with the record data.
     *
     * @return int Returns the record ID.
     *
     * @throws InvalidArgumentException
     */
    public function add(array $record): int
    {
        return $this->save($record);
    }

    public function cast(array &$record)
    {
        foreach ($this->casts as $attribute => $cast)
        {
            if ( ! isset($record[$attribute]))
            {
                continue;
            }

            switch ($cast)
            {
                case 'integer':
                    $record[$attribute] = (int)$record[$attribute];
                    break;

                case 'float':
                    $record[$attribute] = (float)$record[$attribute];
                    break;

                case 'boolean':
                    $record[$attribute] = (bool)$record[$attribute];
                    break;

                case 'string':
                    $record[$attribute] = (string)$record[$attribute];
                    break;

                default:
                    throw new RuntimeException('Unsupported cast type provided: ' . $cast);
            }
        }
    }
}
