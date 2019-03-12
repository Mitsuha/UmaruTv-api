# UmaruTV 是一个由 Lumen 编写的 视频点播网站

程序设计：[百度脑图](http://naotu.baidu.com/file/3f778897c959fea255916cb9ff06849c?token=b751d03c3f69d24e)

# todo list
- [] 登录注册
- [] 搜索
- [] 索引
- [] 评论
- [] 弹幕

## All api

|Api|请求方式|简介|请求|返回（json）|
|---|---|---|---|---|
|/login|POST|登录|email,password|code,status,token|
|/register|POST|注册|name,email,password|code,status,token|
|/user/me|GET|已经登录用户信息|NULL||
|/user/{id}/info|GET|获取指定 id 的用户信息|id||
|/animes/|GET|作品查询|NULL|.|
|/animes/timeline|GET|季度新番时间轴|NULL||
|/animes/{id}/info|GET|动漫详情|id||
|/animes/{id}/episodes|GET|查询该动漫的其他季度|id||
|/animes/{id}/video|GET|动漫的视频详情|id||
|/animes/video/{id}/comment|GET|动漫视频的评论|id||
|/comment/create|POST|发表评论|||
|/comment/delete|DELETE|删除评论|||

### 获取指定动漫详情
请求地址：`/animes/{id}/info`
请求方式：`GET`
请求参数：

|参数|传参方式|可选值|
|id|地址栏|[1-9]|

返回参数详解：

|关键词|解释|
|name|动漫名称|
|cover|封面|
|watch|播放量|
|collection|收藏、追番数量|
|danmaku|弹幕总数|
|introduction|简介|
|release_time|上映时间|
|episodes|共有多少集|
|season_id|季度|
|season_id|季度名称|

### 获取动漫的内容详情
请求地址：`/animes/{id}/video`
请求方式：`GET`
请求参数：Null
返回参数详解：

|关键词|解释|
|ranking|排序|
|name|当前集名称|
|info|当前集简介|
|coin|硬币|
|resource|资源|
|resource.*|资源详情|

### 获取所有动漫
请求地址：`/animes/`
请求方式：`GET`
请求参数：Null
返回参数详解：

|关键词|解释|
|current_page|当前页|
|data|数据|
|data.*|动漫详情|
|first_page_url|第一页 api 地址|
|last_page|分页总页数|
|total|总记录|

### 新番时间表
请求地址：`/animes/timeline`
请求方式：`GET`
请求参数：Null
返回参数详解：

|关键词|解释|
|第一维数组|星期几|
|第二维数组|更新的番剧数据|



## 数据库

User

- id
- name
- password
- role

Anime

- id
- name
- watch
- collection
- danmaku
- release_time
- introduction
- season_id
- season_name

Video

- id
- name
- info
- coin

Resource
- id
- video_id
- resource
- type
- resolution
- ranking

Danmaku

- id
- user_id
- video_id
- start_time
- color
- other

Comment

- id
- user_id
- video_id
- content
- like