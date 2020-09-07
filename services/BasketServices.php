<?php
namespace App\services;

use App\controllers\Controller;
use App\entities\Good;
use App\repositories\GoodRepository;

/**
 * Class BasketServices
 * @package App\services
 *
 * @property Controller controller
 */
class BasketServices
{
    const GOODS = 'goods';

    //GoodRepository $goodRepository - репозиторий для получения товара
    public function add(Request $request, GoodRepository $goodRepository)
    {
        $id = $request->getId();
        if (empty($id)) {
            return false;
        }

        /** @var Good $good */
        $good = $goodRepository->getOne($id);
        $good = $this->rewriteFromSql($good);
        if (empty($good)) {
            return false;
        }

        $goods = $request->getSession('goods');
        $total = $request->getSession('total');
        if (empty($total)) {
            $total['count'] = 0;
            $total['price'] = 0;
        }
        if (empty($goods[$id])) {
            $goods[$id] = [
                'good' => $good,
                'count' => 1
            ];
            $total['count'] += 1;
            $total['price'] += $good->getPrice();
        } else {
            $goods[$id]['count']++;
            $total['count'] += 1;
            $total['price'] += $good->getPrice();
        }

        $request->setSession('goods', $goods);
        $request->setSession('total', $total);
        return true;
    }

    public function del(Request $request, $id = '')
    {
        if (empty($id)) {
            return false;
        }

        $goods = $request->getSession('goods');
        if ($goods[$id]['count'] > 1) {
            $goods[$id]['count']--;
        } else {
            unset($goods[$id]);
        }

        $request->setSession('goods', $goods);
        return true;
    }


    public function rewriteFromSql($good)
    {
        foreach ($good as $key => $property) {
            if (false !== strpos($key, "_")) {
                $arr = explode("_", $key);
                $str = $arr[0];
                for ($i = 1, $iMax = count($arr); $i < $iMax; $i++) {
                    $str .= ucfirst($arr[$i]);
                }
                $methodName = "set" . $str;
                $good->$methodName($property);
                unset($good->$key);
            }
        }

        return $good;
    }
}