<?php

namespace Drupal\show_module\Controller;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Controller\ControllerBase;

class CurrentTimeController extends ControllerBase {

  /**
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * コンストラクタインジェクションを行う  
   * Drupal10.2以前においてController内でserviceを呼びたいときはContainerInterfaceを
   * 利用する。しかしDrupal10.2以降においては、Symfonyの機能であるAutowireingでのDIを行う
   * ことができるようになった。(services.ymlでautowire: true の場合のみ)
   * @param \Drupal\Core\Datetime\DateFormatterInterface $date_formatter
   */
  public function __construct(
    #[Autowire(service: 'date.formatter')] 
    DateFormatterInterface $date_formatter
    ) {
    $this->dateFormatter = $date_formatter;
  }

  /**
   * @return array
   */
  public function currentTime() {
    // 現在のタイムスタンプを取得
    $timestamp = \Drupal::time()->getRequestTime();
    
    // 現在の時刻をフォーマット
    $current_time = $this->dateFormatter->format($timestamp, 'custom', 'Y-m-d H:i:s');

    return [
      '#markup' => $this->t('Current time: @time', ['@time' => $current_time]),
    ];
  }

}














