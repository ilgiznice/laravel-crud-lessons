<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Export extends Model
{
    const DELIMITER = ';';
    const FILE_PATH = 'export/';

    /**
     * Инициирует процесс экспорта
     *
     * @return string
     */
    public function run()
    {
        $filePath = $this->toCsv($this->getEntities());
        return $this->getDownloadLink($filePath);
    }

    /**
     * Формирует ссылку для скачивания
     *
     * @param $filePath
     * @return string
     */
    protected function getDownloadLink($filePath)
    {
        return asset(Storage::url($filePath));
    }
    /**
     * Добавляет строку в файл
     *
     * @param $filePath
     * @param $content
     * @return int
     */
    protected function saveFile($filePath, $content)
    {
        return Storage::append($filePath, $content);
    }

    /**
     * Возвращает готовый текст в формате csv, с указанным разделителем
     *
     * @param $entities
     * @return string
     */
    protected function toCsv($entities)
    {
        $fileName = str_random() . '.csv';
        $filePath = self::FILE_PATH . $fileName;
        foreach ($entities as $entity) {
            $this->saveFile($filePath, $this->buildString($entity));
        }
        return $filePath;
    }

    /**
     * Получение сущностей для экспорта
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    protected function getEntities()
    {
        return Product::all();
    }

    /**
     * Подготовка строки для дальнейшего формирования текста
     *
     * @param $entity
     * @return string
     */
    protected function buildString($entity)
    {
        $map = [
            'title' => $entity->title,
            'price' => $entity->price
        ];
        return implode(self::DELIMITER, $map);
    }
}
