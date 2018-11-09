<?php

namespace App\Services\Filters;

use App\Services\ConfigUploader\ConfigUploaderInterface;
use App\Services\Container\ContainerInterface;
use App\Services\Filters\Contract\CompositeInterface;
use App\Services\Filters\Contract\FilterInterface;
use App\Services\Filters\Exceptions\FilterBuildingException;

/**
 * Class Factory
 * @package App\Services\Filters
 */
final class Factory
{
    const CONFIG_PATH = 'filters.schema.schema';
    const DEFAULT_SCENARIO = 'default';

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var array
     */
    private $schema = [];

    /**
     * Factory constructor.
     * @param ContainerInterface $container
     * @param ConfigUploaderInterface $configUploader
     */
    public function __construct(ContainerInterface $container, ConfigUploaderInterface $configUploader)
    {
        $this->container = $container;
        $this->configure($configUploader);
    }

    /**
     * @param ConfigUploaderInterface $configUploader
     */
    private function configure(ConfigUploaderInterface $configUploader)
    {
        $configs = $configUploader->getConfigs(self::CONFIG_PATH);
        $this->schema = $configs ?: [];
    }

    /**
     * @param string $alias
     * @return FilterInterface
     * @throws FilterBuildingException
     */
    public function buildFilter(string $alias): FilterInterface
    {
        try {
            return $this->proceed($alias);
        } catch (\Throwable $exception) {
            throw new FilterBuildingException(
                sprintf(
                    'Cannot build filter by given alias - %s. %s',
                    $alias,
                    $exception->getMessage()
                )
            );
        }
    }

    /**
     * @param string $alias
     * @return FilterInterface
     */
    private function proceed(string $alias)
    {
        $configs = $this->getSchemaForScenario($alias);
        $filter = $this->resolve($configs['filter']);

        return $filter instanceof CompositeInterface
            ? $this->fillComposite($filter, $configs['items'] ?? [])
            : $filter;

    }

    /**
     * @param CompositeInterface $composite
     * @param array $items
     * @return FilterInterface
     */
    private function fillComposite(CompositeInterface $composite, array $items): FilterInterface
    {
        foreach ($items as $item) {
            $composite->addFilter($this->resolve($item));
        }

        /**
         * @var FilterInterface $composite
         */
        return $composite;
    }

    /**
     * @param string $alias
     * @return mixed
     */
    private function getSchemaForScenario(string $alias)
    {
        return $this->schema[$alias] ?? $this->schema[self::DEFAULT_SCENARIO];
    }

    /**
     * @param string $className
     * @return FilterInterface
     */
    private function resolve(string $className): FilterInterface
    {
        return $this->container->build($className);
    }
}