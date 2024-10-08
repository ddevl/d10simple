<?php

declare(strict_types=1);

namespace Drupal\Tests\image\FunctionalJavascript;

use Drupal\FunctionalJavascriptTests\WebDriverTestBase;
use Drupal\Tests\image\Kernel\ImageFieldCreationTrait;
use Drupal\Tests\TestFileCreationTrait;

/**
 * This class provides methods specifically for testing Image's field handling.
 */
abstract class ImageFieldTestBase extends WebDriverTestBase {

  use ImageFieldCreationTrait;
  use TestFileCreationTrait {
    getTestFiles as drupalGetTestFiles;
  }

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'node',
    'image',
    'field_ui',
    'image_module_test',
  ];

  /**
   * A user with permissions to administer content types and image styles.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $adminUser;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    // Create Basic page and Article node types.
    if ($this->profile !== 'standard') {
      $this->drupalCreateContentType(['type' => 'page', 'name' => 'Basic page']);
      $this->drupalCreateContentType(['type' => 'article', 'name' => 'Article']);
    }

    $this->adminUser = $this->drupalCreateUser([
      'access content',
      'access administration pages',
      'administer site configuration',
      'administer content types',
      'administer node fields',
      'administer nodes',
      'create article content',
      'edit any article content',
      'delete any article content',
      'administer image styles',
      'administer node display',
    ]);
    $this->drupalLogin($this->adminUser);
  }

}
