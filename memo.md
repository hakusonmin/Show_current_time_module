port=3600



## 使用したAPI
・TimeInterface::getRequestTime
https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Component%21Datetime%21TimeInterface.php/interface/TimeInterface/8.9.x 
・DateFormatterInterface::format
https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Datetime%21DateFormatterInterface.php/interface/DateFormatterInterface/8.9.x

## ::を使った静的な呼び方とServiceをDIして使うやり方の違い。<br>
静的呼び出しはどこからでも呼べるため、便利だが、それゆえコードの治安が悪くなりやすい。
そのため単純なユーティリティメソッド程度なら静的呼び出しを利用し、アプリケーション(ビジネス)ロジックが書かれている機能はDIを使うべき。