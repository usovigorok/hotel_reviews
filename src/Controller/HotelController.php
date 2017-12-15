<?php
/**
 * Created by IntelliJ IDEA.
 * User: igor
 * Date: 15.12.17
 * Time: 16:22
 */

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HotelController extends Controller
{
    public function getRatingScoreAction($uuid)
    {
        $hotel = $this->getDoctrine()
            ->getRepository(Hotel::class)
            ->findOneBy(array(
                'uiid' => $uuid
            ));

        if (!$hotel) {
            throw new \Exception('Hotel does not exist');
        }

        $score = $this->getDoctrine()
            ->getRepository(Review::class)
            ->findScoreForHotel($hotel);
        $score = number_format($score, 2);

        $js = "document.body.innerHTML +='<div style=\"position:fixed;bottom:0;right:0;width:100px;height:100px;background:blue;text-align:center;line-height:100px;color:white;\"><b>{$score}%</b></div>';";

        $response = new Response(
            $js,
            Response::HTTP_OK,
            array('content-type' => 'text/javascript')
        );

        return $response;
    }

}