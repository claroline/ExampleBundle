<?php

namespace Claroline\ExampleBundle\Listener;

use Claroline\CoreBundle\Library\Tool\Event\DisplayToolEvent;
use Symfony\Component\DependencyInjection\ContainerAware;

class ToolListener extends ContainerAware
{
    public function onWorkspaceOpen(DisplayToolEvent $event)
    {
        $event->setContent($this->workspace($event->getWorkspace()->getId()));
    }

    public function onDesktopOpen(DisplayToolEvent $event)
    {
        $event->setContent($this->desktop());
    }

    private function workspace($workspaceId)
    {
        //if you want to keep the context, you must retrieve the workspace.
        $em = $this->container->get('doctrine.orm.entity_manager');
        $workspace = $em->getRepository('ClarolineCoreBundle:Workspace\AbstractWorkspace')->find($workspaceId);

        return $this->container->get('templating')->render(
            'ClarolineExampleBundle::workspace_tool.html.twig', array('workspace' => $workspace)
        );
    }

    private function desktop()
    {
        return $this->container->get('templating')->render(
            'ClarolineExampleBundle::desktop_tool.html.twig'
        );
    }
}