# API設計

## REST APIとは

- HTTPの技術を最大限活用する、シンプルな設計方法
- 「何のリソース」を「どのように」操作するかをURIやHTTPメソッドで表現する
- リソース指向の設計
- セッションなどの状態を管理せず、必ずそのリクエストで処理が完結する

## URLの設計

1. ひと目でAPIと分かるようなURLにする
    - ディレクトリに分ける　 https://example.com/api
    - サブドメインを作成する https://api.example.com

2. URLにAPIのバージョンを含める  
    
    ※　URLにバージョンを含めることで、開発者がAPIのバージョンを選択しやすくなる
    - https://api.example.com/1/article
    - https://api.example.com/v1/article

3. URLに動詞を含めず、複数形の名刺のみで構成する
    - 悪いパターン
        - http://api.example.com/v1/createArticle
        - http://api.example.com/v1/article/create
        - http://api.example.com/v1/article/126/create
        - http://api.example.com/v1/article/createComment
        - http://api.example.com/v1/article/126/comment/10/create  
    
    一見URLをみただけで操作がわかって良いように見えるが、  
    リソースを操作する分URLが増えてしまうし、リソースに対して一意ではない
   
    - 良いパターン
        - http://api.example.com/v1/articles
        - http://api.example.com/v1/articles/126
        - http://api.example.com/v1/articles/126/comments
        - http://api.example.com/v1/articles/126/comments/10
    
    上記のように、どのリソースに対する操作なのかがひと目で分かるように作成する
    
4. パラメータの適切な受け渡し
    - クエリパラメータ  
    任意のパラメータであり、そのパラメータがなくてもリソースとして成り立つものに使用
    - パスパラメータ  
    個別のリソースを特定するための、必須のパラメータに使用
    
5. アプリケーションや言語に依存する拡張子は含めない
6. リソースの関係性がひと目で分かるようにする
7. 冗長なものにしない

