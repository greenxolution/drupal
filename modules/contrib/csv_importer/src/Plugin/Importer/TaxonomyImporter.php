<?php

namespace Drupal\csv_importer\Plugin\Importer;

use Drupal\csv_importer\Plugin\ImporterBase;

/**
 * Class to import taxonomy terms.
 *
 * @Importer(
 *   id = "taxonomy_term_importer",
 *   entity_type = "taxonomy_term",
 *   label = @Translation("Taxonomy importer")
 * )
 */
class TaxonomyImporter extends ImporterBase {}
