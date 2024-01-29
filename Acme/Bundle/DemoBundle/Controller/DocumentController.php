<?php
namespace Acme\Bundle\DemoBundle\Controller;

use Acme\Bundle\DemoBundle\Entity\Document;
use Acme\Bundle\DemoBundle\Form\Type\DocumentType;
use Oro\Bundle\DataGridBundle\Provider\ConfigurationProviderInterface;
use Oro\Bundle\FormBundle\Model\UpdateHandlerFacade;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Oro\Bundle\UIBundle\Route\Router;

/**
 * Contains CRUD actions for Document
 */
class DocumentController extends AbstractController
{
    /**
     * @Route(
     *      "/document", 
     *      name="acme_index_document"
     * )
     * @Template
     * @AclAncestor("acme_demo_document_view")
     */
    public function indexAction(): array
    {
        return [
            'entity_class' => Document::class
        ];
    }

    /**
     * @Route("/view/{id}", name="acme_demo_document_view", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="acme_demo_document_view",
     *      type="entity",
     *      class="AcmeDemoBundle:Document",
     *      permission="VIEW"
     * )
     */
    public function viewAction(Document $entity): array
    {
        return [
            'entity' => $entity,
        ];
    }

    /**
     * Create Document
     *
     * @Route("/create", name="acme_demo_document_create")
     * @Acl(
     *      id="acme_demo_document_create",
     *      type="entity",
     *      class="Acme\Bundle\DemoBundle\Entity\Document",
     *      permission="CREATE"
     * )
     * @Template("@AcmeDemo/Document/update.html.twig")
     */
    public function createAction(Request $request): array|RedirectResponse
    {
        $createMessage = $this->get(TranslatorInterface::class)->trans(
            'acme.demo.controller.document.saved.message'
        );
        $Document = new Document();
        return $this->update($Document, $request, $createMessage);
    }

    /**
     * Edit Document form
     *
     * @Route("/update/{id}", name="acme_demo_document_update", requirements={"id"="\d+"})
     * @Acl(
     *      id="acme_demo_document_update",
     *      type="entity",
     *      class="Acme\Bundle\DemoBundle\Entity\Document",
     *      permission="EDIT"
     * )
     * @Template()
     */
    public function updateAction(Document $entity, Request $request): array|RedirectResponse
    {
        $updateMessage = $this->get(TranslatorInterface::class)->trans(
            'acme.demo.controller.document.saved.message'
        );

        return $this->update($entity, $request, $updateMessage);
    }

    protected function update( Document $entity, Request $request, string $message = '' ): array|RedirectResponse 
    {
        return $this->get(UpdateHandlerFacade::class)->update(
            $entity,
            $this->createForm(DocumentType::class, $entity),
            $message
        );
    }

    public static function getSubscribedServices()
    {
        return array_merge(
            parent::getSubscribedServices(),
            [
                TranslatorInterface::class,
                UpdateHandlerFacade::class,
                Router::class,
                ConfigurationProviderInterface::class
            ]
        );
    }
}