<?php


namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AdsController extends Controller
{
    /**
     * @Route("/showAd", name="show_ad")
     */
    public function showAdAction()
    {
        $ad = $this->getAd();

        return $this->render('ads/show_ad.html.twig', $ad);
    }

    /**
     * @Route("/apiAds/{hash}", name="api_ads")
     * @Method("GET")
     */
    public function apiAdsAction($hash)
    {
        $seo = $this->render('ads/api_ads_seo.html.twig');
        $sem = $this->render('ads/api_ads_sem.html.twig');

        //var_dump($seo->getContent());die();

        $clients = [
            md5(1) => $seo->getContent(),
            md5(2) => 'Dwójka',
            md5(3) => $sem->getContent()
        ];

        $data = [];

        foreach ($clients as $key => $value) {
            if ($hash == $key) {
                $data['ad'][$hash] = $value;
            }
        }


        return new JsonResponse($data);
    }

    private function getAd($url = 'http://dev.technet.systems/json/test.json')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
        $data = json_decode(curl_exec($ch), true);
        curl_close($ch);

        return $data;

        /*
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/apiAds/c4ca4238a0b923820dcc509a6f75849b');

        curl_setopt ($ch, CURLOPT_PORT , 8089);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);

        var_dump($response);die();

        $data = json_decode($response);

        return $data;
        */
    }
}