<?php
namespace MixtapeQode\Modules\Shortcodes\Lib;

use MixtapeQode\Modules\Shortcodes\Accordion\Accordion;
use MixtapeQode\Modules\Shortcodes\AccordionTab\AccordionTab;
use MixtapeQode\Modules\Shortcodes\AlbumDisc\AlbumDisc;
use MixtapeQode\Modules\Shortcodes\Blockquote\Blockquote;
use MixtapeQode\Modules\Shortcodes\BlogList\BlogList;
use MixtapeQode\Modules\Shortcodes\BlogSlider\BlogSlider;
use MixtapeQode\Modules\Shortcodes\BoxedIcon\BoxedIcon;
use MixtapeQode\Modules\Shortcodes\BoxedIcons\BoxedIcons;
use MixtapeQode\Modules\Shortcodes\Button\Button;
use MixtapeQode\Modules\Shortcodes\CallToAction\CallToAction;
use MixtapeQode\Modules\Shortcodes\Client\Client;
use MixtapeQode\Modules\Shortcodes\Clients\Clients;
use MixtapeQode\Modules\Shortcodes\Counter\Countdown;
use MixtapeQode\Modules\Shortcodes\Counter\Counter;
use MixtapeQode\Modules\Shortcodes\CustomFont\CustomFont;
use MixtapeQode\Modules\Shortcodes\DeviceShowcase\DeviceShowcase;
use MixtapeQode\Modules\Shortcodes\Dropcaps\Dropcaps;
use MixtapeQode\Modules\Shortcodes\ElementsHolder\ElementsHolder;
use MixtapeQode\Modules\Shortcodes\ElementsHolderItem\ElementsHolderItem;
use MixtapeQode\Modules\Shortcodes\GoogleMap\GoogleMap;
use MixtapeQode\Modules\Shortcodes\Highlight\Highlight;
use MixtapeQode\Modules\Shortcodes\Icon\Icon;
use MixtapeQode\Modules\Shortcodes\IconListItem\IconListItem;
use MixtapeQode\Modules\Shortcodes\IconWithText\IconWithText;
use MixtapeQode\Modules\Shortcodes\ImageGallery\ImageGallery;
use MixtapeQode\Modules\Shortcodes\ImageWithText\ImageWithText;
use MixtapeQode\Modules\Shortcodes\ImageWithTextOver\ImageWithTextOver;
use MixtapeQode\Modules\Shortcodes\ImageWithTitle\ImageWithTitle;
use MixtapeQode\Modules\Shortcodes\Message\Message;
use MixtapeQode\Modules\Shortcodes\OrderedList\OrderedList;
use MixtapeQode\Modules\Shortcodes\ParallaxHolder\ParallaxHolder;
use MixtapeQode\Modules\Shortcodes\PieCharts\PieChartBasic\PieChartBasic;
use MixtapeQode\Modules\Shortcodes\PieCharts\PieChartDoughnut\PieChartDoughnut;
use MixtapeQode\Modules\Shortcodes\PieCharts\PieChartDoughnut\PieChartPie;
use MixtapeQode\Modules\Shortcodes\PieCharts\PieChartWithIcon\PieChartWithIcon;
use MixtapeQode\Modules\Shortcodes\PricingTables\PricingTables;
use MixtapeQode\Modules\Shortcodes\PricingTable\PricingTable;
use MixtapeQode\Modules\Shortcodes\Process\ProcessHolder;
use MixtapeQode\Modules\Shortcodes\Process\ProcessItem;
use MixtapeQode\Modules\Shortcodes\ProgressBar\ProgressBar;
use MixtapeQode\Modules\Shortcodes\Separator\Separator;
use MixtapeQode\Modules\Shortcodes\SocialShare\SocialShare;
use MixtapeQode\Modules\Shortcodes\Tabs\Tabs;
use MixtapeQode\Modules\Shortcodes\Tab\Tab;
use MixtapeQode\Modules\Shortcodes\Team\Team;
use MixtapeQode\Modules\Shortcodes\UnorderedList\UnorderedList;
use MixtapeQode\Modules\Shortcodes\VerticalSplitSlider\VerticalSplitSlider;
use MixtapeQode\Modules\Shortcodes\VerticalSplitSliderContentItem\VerticalSplitSliderContentItem;
use MixtapeQode\Modules\Shortcodes\VerticalSplitSliderLeftPanel\VerticalSplitSliderLeftPanel;
use MixtapeQode\Modules\Shortcodes\VerticalSplitSliderRightPanel\VerticalSplitSliderRightPanel;
use MixtapeQode\Modules\Shortcodes\VideoButton\VideoButton;
use MixtapeQode\Modules\Shortcodes\ItemShowcase\ItemShowcase;
use MixtapeQode\Modules\Shortcodes\ItemShowcaseListItem\ItemShowcaseListItem;
use MixtapeQode\Modules\Shortcodes\AudioPlaylist\AudioPlaylist;
use MixtapeQode\Modules\Shortcodes\SectionSubtitle\SectionSubtitle;
use MixtapeQode\Modules\Shortcodes\Banner\Banner;
use MixtapeQode\Modules\Shortcodes\FrameCarousel\FrameCarousel;
use MixtapeQode\Modules\Shortcodes\AnchorMenu\AnchorMenu;

/**
 * Class ShortcodeLoader
 */
class ShortcodeLoader {
	/**
	 * @var private instance of current class
	 */
	private static $instance;
	/**
	 * @var array
	 */
	private $loadedShortcodes = array();

	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {}

	/**
	 * Private sleep because of Singletone
	 */
	private function __wakeup() {}

	/**
	 * Private clone because of Singletone
	 */
	private function __clone() {}

	/**
	 * Returns current instance of class
	 * @return ShortcodeLoader
	 */
	public static function getInstance() {
		if(self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}

	/**
	 * Adds new shortcode. Object that it takes must implement ShortcodeInterface
	 * @param ShortcodeInterface $shortcode
	 */
	private function addShortcode(ShortcodeInterface $shortcode) {
		if(!array_key_exists($shortcode->getBase(), $this->loadedShortcodes)) {
			$this->loadedShortcodes[$shortcode->getBase()] = $shortcode;
		}
	}

	/**
	 * Adds all shortcodes.
	 *
	 * @see ShortcodeLoader::addShortcode()
	 */
	private function addShortcodes() {
		$this->addShortcode(new Accordion());
		$this->addShortcode(new AccordionTab());
		$this->addShortcode(new AlbumDisc());
		$this->addShortcode(new AudioPlaylist());
		$this->addShortcode(new Banner());
		$this->addShortcode(new Blockquote());
		$this->addShortcode(new BlogList());
		$this->addShortcode(new BlogSlider());
		$this->addShortcode(new BoxedIcons());
		$this->addShortcode(new BoxedIcon());
		$this->addShortcode(new Button());
		$this->addShortcode(new CallToAction());
		$this->addShortcode(new Clients());
		$this->addShortcode(new Client());
		$this->addShortcode(new Counter());
		$this->addShortcode(new Countdown());
		$this->addShortcode(new CustomFont());
		$this->addShortcode(new DeviceShowcase());
		$this->addShortcode(new Dropcaps());
		$this->addShortcode(new ElementsHolder());
		$this->addShortcode(new ElementsHolderItem());
		$this->addShortcode(new FrameCarousel());
		$this->addShortcode(new GoogleMap());
		$this->addShortcode(new Highlight());
		$this->addShortcode(new Icon());
		$this->addShortcode(new IconListItem());
		$this->addShortcode(new IconWithText());
		$this->addShortcode(new ImageGallery());
		$this->addShortcode(new ImageWithText());
		$this->addShortcode(new ImageWithTextOver());
		$this->addShortcode(new ImageWithTitle());
		$this->addShortcode(new Message());
		$this->addShortcode(new OrderedList());
		$this->addShortcode(new ParallaxHolder());
		$this->addShortcode(new PieChartBasic());
		$this->addShortcode(new PieChartPie());
		$this->addShortcode(new PieChartDoughnut());
		$this->addShortcode(new PieChartWithIcon());
		$this->addShortcode(new PricingTables());
		$this->addShortcode(new PricingTable());
		$this->addShortcode(new ProgressBar());
		$this->addShortcode(new ProcessHolder());
		$this->addShortcode(new ProcessItem());
		$this->addShortcode(new SectionSubtitle());
		$this->addShortcode(new Separator());
		$this->addShortcode(new SocialShare());
		$this->addShortcode(new Tabs());
		$this->addShortcode(new Tab());
		$this->addShortcode(new Team());
		$this->addShortcode(new UnorderedList());
		$this->addShortcode(new VideoButton());
		$this->addShortcode(new VerticalSplitSlider());
		$this->addShortcode(new VerticalSplitSliderLeftPanel());
		$this->addShortcode(new VerticalSplitSliderRightPanel());
		$this->addShortcode(new VerticalSplitSliderContentItem());
		$this->addShortcode(new ItemShowcase());
		$this->addShortcode(new ItemShowcaseListItem());
		$this->addShortcode(new AnchorMenu());
	}
	/**
	 * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
	 * of each shortcode object
	 */
	public function load() {
		$this->addShortcodes();

		foreach ($this->loadedShortcodes as $shortcode) {
			add_shortcode($shortcode->getBase(), array($shortcode, 'render'));
		}
	}
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();