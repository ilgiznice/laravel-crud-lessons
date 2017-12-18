<?php

namespace App;

use File;
use Illuminate\Http\UploadedFile;

class Import
{
    const DELIMITER = ';';

    protected $file = null;

    /**
     * Import constructor.
     * @param UploadedFile $file
     */
    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    /**
     * Построчное считывание файла
     */
    public function run()
    {
        $rows = file($this->file->getRealPath());
        foreach ($rows as $row) {
            $fields = $this->mapFields($row);
            $this->createProduct($fields);
        }
    }

    /**
     * Создает продукт в БД
     *
     * @param array $fields
     * @return bool
     */
    protected function createProduct(array $fields)
    {
        $product = new Product($fields);
        return $product->save();
    }

    /**
     * Соотнесение столбцов бд с столбцами в файле
     *
     * @param $row
     * @return array
     */
    protected function mapFields($row)
    {
        $row = str_replace("\n",'',$row);
        $fields = explode(self::DELIMITER, $row);
        $map = [
            'title' => $fields[0],
            'price' => $fields[1],
        ];
        return $map;
    }
}
