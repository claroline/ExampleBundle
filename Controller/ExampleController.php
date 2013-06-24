<?php

namespace Claroline\ExampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ExampleController extends Controller
{
    /**
     * @Route(
     *     "/open/{exampleId}",
     *     name = "claro_example_open"
     * )
     *
     * @Template("ClarolineExampleBundle::resource.html.twig")
     *
     * @param integer $exampleId
     *
     * @return Response
     */
    public function openAction($exampleId)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        //get the resource
        $resource = $em->getRepository('ClarolineCoreBundle:Resource\AbstractResource')->find($exampleId);

        //get the text.
        return array('_resource' => $resource);
    }
}