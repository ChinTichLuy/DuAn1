<?php

namespace App\Models;

use App\Commons\Model;
use Exception;

class Product extends Model
{
    protected string $tableName = 'products';

    public function getAllShop($page = 1, $perPage = self::PER_PAGE)
    {
        $queryBuilder = clone ($this->queryBuilder);
        $totalPage = ceil($this->count() / $perPage);
        $offset = $perPage * ($page - 1);
        try {
            $data = $queryBuilder
                ->select(
                    'p.id as p_id',
                    'p.name as p_name',
                    'p.slug as p_slug',
                    'p.sku as p_sku',
                    'p.thumb_image as p_thumb_image',
                    'p.price_regular as p_price_regular',
                    'p.price_sale as p_price_sale',
                    'p.description as p_description',
                    'p.content as p_content',
                    'p.views as p_views',
                    'p.is_active as p_is_active',
                    'p.is_hot_deal as p_is_hot_deal',
                    'p.is_good_deal as p_is_good_deal',
                    'p.is_new as p_is_new',
                    'p.is_show_home as p_is_show_home',
                    'p.created_at as p_created_at',
                    'p.updated_at as p_updated_at',
                    'c.id as c_id',
                    'c.name as c_name',
                    'c.slug as c_slug',
                )
                ->from($this->tableName, 'p')
                ->innerJoin('p', 'categories', 'c', 'p.category_id = c.id')
                ->setFirstResult($offset)
                ->setMaxResults($perPage)
                ->orderBy('p.id', 'DESC')
                ->fetchAllAssociative();
            return [$data, $totalPage];
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function findBySlug($slug)
    {
        try {
            return $this->queryBuilder
                ->select(
                    'c.id as c_id',
                    'c.name as c_name',
                    'c.slug as c_slug',
                    'p.id as p_id',
                    'p.name as p_name',
                    'p.slug as p_slug',
                    'p.sku as p_sku',
                    'p.thumb_image as p_thumb_image',
                    'p.price_regular as p_price_regular',
                    'p.price_sale as p_price_sale',
                    'p.description as p_description',
                    'p.content as p_content',
                    'p.views as p_views',
                    'p.is_active as p_is_active',
                    'p.is_hot_deal as p_is_hot_deal',
                    'p.is_good_deal as p_is_good_deal',
                    'p.is_new as p_is_new',
                    'p.is_show_home as p_is_show_home',
                    'p.created_at as p_created_at',
                    'p.updated_at as p_updated_at',
                )
                ->from($this->tableName, 'p')
                ->innerJoin('p', 'categories', 'c', 'p.category_id = c.id')
                ->where('p.slug = :slug')
                ->setParameter('slug', $slug)
                ->fetchAssociative();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }

    public function getTop10NewProductHome($limit = 10)
    {
        try {
            $query = clone ($this->queryBuilder);

            $data = $query
                ->select(
                    'p.id as p_id',
                    'p.name as p_name',
                    'p.slug as p_slug',
                    'p.sku as p_sku',
                    'p.thumb_image as p_thumb_image',
                    'p.price_regular as p_price_regular',
                    'p.price_sale as p_price_sale',
                    'p.description as p_description',
                    'p.content as p_content',
                    'p.views as p_views',
                    'p.is_active as p_is_active',
                    'p.is_hot_deal as p_is_hot_deal',
                    'p.is_good_deal as p_is_good_deal',
                    'p.is_new as p_is_new',
                    'p.is_show_home as p_is_show_home',
                    'p.created_at as p_created_at',
                    'p.updated_at as p_updated_at',
                    'c.id as c_id',
                    'c.name as c_name',
                    'c.slug as c_slug',
                )
                ->from($this->tableName, 'p')
                ->innerJoin('p', 'categories', 'c', 'p.category_id = c.id')
                ->setMaxResults($limit)
                ->where('p.is_show_home = 1')
                ->andWhere('p.is_new = 1')
                ->orderBy('p.id', 'DESC')
                ->fetchAllAssociative();

            return $data;
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }

    public function getTop10SaleProduct($limit = 10)
    {
        try {
            $query = clone ($this->queryBuilder);

            $data = $query
                ->select(
                    'p.id as p_id',
                    'p.name as p_name',
                    'p.slug as p_slug',
                    'p.sku as p_sku',
                    'p.thumb_image as p_thumb_image',
                    'p.price_regular as p_price_regular',
                    'p.price_sale as p_price_sale',
                    'p.description as p_description',
                    'p.content as p_content',
                    'p.views as p_views',
                    'p.is_active as p_is_active',
                    'p.is_hot_deal as p_is_hot_deal',
                    'p.is_good_deal as p_is_good_deal',
                    'p.is_new as p_is_new',
                    'p.is_show_home as p_is_show_home',
                    'p.created_at as p_created_at',
                    'p.updated_at as p_updated_at',
                    'c.id as c_id',
                    'c.name as c_name',
                    'c.slug as c_slug',
                )
                ->from($this->tableName, 'p')
                ->innerJoin('p', 'categories', 'c', 'p.category_id = c.id')
                ->setMaxResults($limit)
                ->where('p.is_show_home = 1')
                ->andWhere('p.is_good_deal = 1')
                ->orderBy('p.id', 'DESC')
                ->fetchAllAssociative();

            return $data;
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }

    public function getTop10Product($limit = 10)
    {
        try {
            $query = clone ($this->queryBuilder);

            $data = $query
                ->select(
                    'p.id as p_id',
                    'p.name as p_name',
                    'p.slug as p_slug',
                    'p.sku as p_sku',
                    'p.thumb_image as p_thumb_image',
                    'p.price_regular as p_price_regular',
                    'p.price_sale as p_price_sale',
                    'p.description as p_description',
                    'p.content as p_content',
                    'p.views as p_views',
                    'p.is_active as p_is_active',
                    'p.is_hot_deal as p_is_hot_deal',
                    'p.is_good_deal as p_is_good_deal',
                    'p.is_new as p_is_new',
                    'p.is_show_home as p_is_show_home',
                    'p.created_at as p_created_at',
                    'p.updated_at as p_updated_at',
                    'c.id as c_id',
                    'c.name as c_name',
                    'c.slug as c_slug',
                )
                ->from($this->tableName, 'p')
                ->innerJoin('p', 'categories', 'c', 'p.category_id = c.id')
                ->setMaxResults($limit)
                ->where('p.is_show_home = 1')
                ->orderBy('p.id', 'DESC')
                ->fetchAllAssociative();

            return $data;
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }

    // filter product
    public function filterProduct($page = 1, $perPage = self::PER_PAGE, $key = null, $categoryId = null)
    {
        $queryBuilder = clone ($this->queryBuilder);
        $totalPage = ceil($this->count() / $perPage);
        $offset = $perPage * ($page - 1);
        try {
            $queryBuilder
                ->select(
                    'p.id as p_id',
                    'p.name as p_name',
                    'p.slug as p_slug',
                    'p.sku as p_sku',
                    'p.thumb_image as p_thumb_image',
                    'p.price_regular as p_price_regular',
                    'p.price_sale as p_price_sale',
                    'p.description as p_description',
                    'p.content as p_content',
                    'p.views as p_views',
                    'p.is_active as p_is_active',
                    'p.is_hot_deal as p_is_hot_deal',
                    'p.is_good_deal as p_is_good_deal',
                    'p.is_new as p_is_new',
                    'p.is_show_home as p_is_show_home',
                    'p.created_at as p_created_at',
                    'p.updated_at as p_updated_at',
                    'c.id as c_id',
                    'c.name as c_name',
                    'c.slug as c_slug',
                )
                ->from($this->tableName, 'p')
                ->innerJoin('p', 'categories', 'c', 'p.category_id = c.id');

            if ($key != null) {
                $queryBuilder->where('p.name LIKE :key')->setParameter('key', "%{$key}%");
            }

            if ($categoryId != null) {
                $queryBuilder->where('p.category_id = :categoryId')->setParameter('categoryId', $categoryId);
            }

            $data = $queryBuilder
                ->setFirstResult($offset)
                ->setMaxResults($perPage)
                ->orderBy('p.id', 'DESC')
                ->fetchAllAssociative();


            return [$data, $totalPage];
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
