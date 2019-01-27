# Lvideo 是一个由 Laravel 编写的 视频点播网站

程序设计：[百度脑图](http://naotu.baidu.com/file/3f778897c959fea255916cb9ff06849c?token=b751d03c3f69d24e)

## 预料之内的漏洞
- 处理用户会话时使用了并不熟悉的 JWT，因为 JWT 的不可控性导致了如下可能会被利用的 BUG
 - 在用户注销时只是单纯的在客户端删除了登录凭证，因此在第三方盗取令牌后注销并不能保证此次回话作废
 - 续签时多并发会出现签署多张令牌的情况
 - 重放攻击


## All api

|Api|请求方式|简介|
|---|---|---|
|/login|POST|登录|
|/register|POST|注册|
|/user/self|GET|已经登录用户信息|
|/user/{id}/info|GET|获取指定 id 的用户信息|
|/animes/|GET|作品查询|
|/animes/timeline|GET|季度新番时间轴|
|/animes/{id}/info|GET|动漫详情|
|/animes/{id}/episodes|GET|查询该动漫的其他季度|
|/animes/{id}/video|GET|动漫的视频详情|
|/animes/video/{id}/comment|GET|动漫视频的评论|
|/comment/create|POST|发表评论|
|/comment/delete|DELETE|删除评论|


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