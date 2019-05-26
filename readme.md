# UmaruTV 是一个由 Lumen 编写的 视频点播网站

程序设计：[百度脑图](http://naotu.baidu.com/file/3f778897c959fea255916cb9ff06849c?token=b751d03c3f69d24e)

## todo list
- [ ] 登录注册
- [ ] 搜索
- [ ] 索引
- [ ] 评论
- [ ] 弹幕

## All api
[登录](#登录)  
[注册](#注册)  
[获取指定动漫详情](#获取指定动漫详情)  
[获取动漫的内容详情](#获取动漫的内容详情)  
[获取指定集的资源](#获取指定集的资源)  
[获取所有动漫](#获取所有动漫)  
[新番时间表](#新番时间表)  
[获取最近更新的作品](#获取最近更新的作品)  
[查询标签](#查询标签)  
[弹幕](#弹幕)  

|Api|请求方式|简介|请求|返回（json）|
|---|---|---|---|---|
|/user/me|GET|已经登录用户信息|NULL||
|/user/{id}/info|GET|获取指定 id 的用户信息|id||

### 登录
请求地址：`/login`    
请求方式：`POST`  
请求参数：

|参数|传参方式|必须|可选值|
|---|---|---|---|
|email|POST|是|none|
|password|POST|是|none|

返回参数：

|关键词|解释|
|---|---|
|code|状态|
|status|状态|
|token|令牌，请在 Header 中加入`Authorization`字段，值为`Bearer xxx.xxx.xxx`|

### 注册
请求地址：`/register`    
请求方式：`POST`  
请求参数：

|参数|传参方式|必须|可选值|
|---|---|---|---|
|name|POST|是|none|
|email|POST|是|none|
|password|POST|是|none|

返回参数： [同登录](#登录)

### 获取指定动漫详情
请求地址：`/animes/{id}/info`  
请求方式：`GET`  
请求参数：  

|参数|传参方式|必须|可选值|
|---|---|---|---|
|id|URL|是|[1-9]|
|withVideo|GET|否|`true`会返回动漫里的视频详情|

返回参数：  

|关键词|解释|
|---|---|
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
请求参数：  

|参数|传参方式|必须|可选值|
|---|---|---|---|
|with|GET|否|`resource` 带此参数会返回资源数据|

返回参数：  

|关键词|解释|
|---|---|
|ranking|排序|
|name|当前集名称|
|info|当前集简介|
|coin|硬币|
|resource.*|资源详情|

### 获取指定集的资源
请求地址：`/animes/video/{id}/resource`  
请求方式：`GET`  
请求参数：

|参数|传参方式|必须|可选值|
|---|---|---|---|
|id|URL|是|[0-9]|
|info|GET|否|`true` 带此参数会连同该集信息一并返回|

返回参数：

|关键字|解释|
|---|---|
|resource|资源地址|
|type|资源类型|
|resolution|解析度：`380p` `720p` `1080p`|
|ranking|排序|

### 获取所有动漫
请求地址：`/animes/` 别名： `/animes/index`    
请求方式：`GET`  
请求参数：

|参数|传参方式|必须|可选值|
|---|---|---|---|
|paginate|GET|否|`[0-9]` 每页显示多少数据|
|tag|GET|否|`[0-9]` 根据 `tag id` 筛选数据|


返回参数：  

|关键词|解释|
|---|---|
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
返回参数：  

|关键词|解释|
|---|---|
|一维数组|星期几|
|二维数组|更新的番剧数据|

### 获取最近更新的作品
请求地址：`/animes/recently-updated`  
请求方式：`GET`  
请求参数：Null  
返回参数：  

|关键词|解释|
|---|---|
|name|名称|
|episodes|更新到第几集|

### 查询标签
- 可用于做番剧索引的场景
请求地址：`/animes/tags`  
请求方式：`GET`  
请求参数：

|参数|传参方式|必须|可选值|
|---|---|---|---|
|type|GET|否|返回的 type 字段，可用于进行简单筛选|

返回参数：

|关键词|解释|
|---|---|
|name|标签名|
|type|标签类型：`style`为风格标签，`local`为地区标签，`season`为季度标签|

### 弹幕
请求地址：`/animes/video/danmaku/`  
请求方式：`GET`  
请求参数：

|参数|传参方式|必须|可选值|
|---|---|---|---|
|id|GET|是|[0-9]|

返回参数：

|关键词|解释|
|---|---|
|code|你猜|
|data|你猜|

### 发送弹幕
请求地址：`/animes/video/danmaku/`  
请求方式：`POST`  
请求参数：

|关键词|解释|
|---|---|
|time|发送时间|
|

## 数据库
- users
- password
- animes
- videos
- danmakus
- comments
- resource
- tag
- anime_tag