<?php

namespace Craue\FormFlowDemoBundle\Form\Type;

use Craue\FormFlowDemoBundle\Entity\Topic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2013-2018 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class TopicCategoryType extends AbstractType {

	/**
	 * @var TranslatorInterface
	 */
	protected $translator;

	public function setTranslator(TranslatorInterface $translator) {
		$this->translator = $translator;
	}

	/**
	 * {@inheritDoc}
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$defaultOptions = [
			'placeholder' => '',
		];

		$defaultOptions['choices'] = function(Options $options) {
			$choices = [];

			foreach (Topic::getValidCategories() as $value) {
				$choices[$this->translator->trans($value, [], 'topicCategories')] = $value;
			}

			ksort($choices);

			return $choices;
		};

		$resolver->setDefaults($defaultOptions);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getParent() {
		return ChoiceType::class;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getBlockPrefix() {
		return 'form_type_topicCategory';
	}

}
