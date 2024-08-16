## 概要
・現在時刻を取得してformatterを利用し加工して表示するカスタムモジュールを作成した。<br>
・カスタムコントローラーに記述されており、pathはcurrent-timeである。

## 工夫した点
・Drupal10.2以前においてController内でserviceを呼びたいとき、ContainerInterfaceを
利用した。しかしDrupal10.2以降においては、Symfonyの機能であるAutowireingでのDIを行う
ことができるようになったためその記法を利用した。(この記法が利用できるのは利用するserviceのservices.ymlでautowire: trueがtrueになっている場合のみ)

・セッターインジェクションではなくコンストラクタインジェクションを利用することによってテストが楽になる。

・DrupalAPIドキュメントの読み方がわかってきた。具体的には、hoge機能を利用したいときは、Drupalの
APIドキュメントでhoge機能を調べ、そこにあるメソッドを静的な形の\Drupal::hoge()->foo()として呼び出す。メソッドの使い方は基本的に「view source」から確認することができる。またオーバーライドを前提とする場合があるので、その場合は「view source」のソース上でオーバーライド前提のメソッドをクリックするとオーバーライド候補のメソッドが表示される。

## 改善点
・本来Controllerにはビジネスロジックを書いてはいけない。そのため、今回のケースでは日付の取得とフォーマットの処理を行うカスタムサービスを作成して、それをController内にDIして、Controller内では表示処理のみを行うようにしなければならなかった。無論、そのカスタムサービスを作成したのであるが、試行錯誤して、drush php:eval '\Drupal::service("my_module")->hoge();' のようにしてもカスタムモジュールが認識されなかった。そのためController内に直接ビジネスロジックを書くような形になってしまった。このことは改善したい。

## 使用したDrupalAPI
・[TimeInterface::getRequestTime](https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Component%21Datetime%21TimeInterface.php/interface/TimeInterface/8.9.x)<br>
・[DateFormatterInterface::format](https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Datetime%21DateFormatterInterface.php/interface/DateFormatterInterface/8.9.x)

## ::を使った静的な呼び方とServiceをDIして使うやり方の違い。
・静的呼び出しはどこからでも呼べるため、便利だが、それゆえコードの治安が悪くなりやすい。
そのため単純なユーティリティメソッド程度なら静的呼び出しを利用し、アプリケーション(ビジネス)ロジックが書かれている機能はDIを使うべき。


