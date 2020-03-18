### 修改用户信息
请求地址：`/user`  
请求方式：POST  
请求数据：
```
{
    "name": "名字",
    "sign": "一句话简介",
    "sex": "1"  // 性别，数字，1男，2女，0保密
}
```
成功返回数据：
```
{
    "status": "success",
    "message": "修改成功"
}
```

### 修改用户头像
请求地址：`/user/modifyAvatar`  
请求方式：POST  
请求数据：表单请求，键是 `avatar`，值是文件  

成功返回数据：
```
{
    "status": "success",
    "message": "修改成功"，
    "path": "storage/xxx/xxx/xxx.jpeg" // 上传的文件路径
}
```

### 修改用户封面
请求地址：`/user/modifyCover`  
请求方式：POST  
请求数据：表单请求，键是 `cover`，值是文件  

成功返回数据：
```
{
    "status": "success",
    "message": "修改成功"，
    "path": "storage/xxx/xxx/xxx.jpeg" // 上传的文件路径
}
```

## 评论相关
备注：这里实现了和B站类似的评论方式，一集一个评论区，可以回复评论，不可以回复回复评论 ~~禁止套娃~~
### 查询动画某一集的所有评论
请求地址：`/animes/episode/{id}/comment`，`id`是要查询的某一集  
请求方式：GET  
请求数据：
```
GET /animes/episode/12/comment
```
成功返回数据：
```
{
    "current_page": 1,    // 当前是第几页
    "data": [    // 当前页的数据
        {
            "id": 14,
            "user_id": 19,
            "episode_id": 1,
            "reply_id": null,
            "content": "Deserunt quis occaecati eos.",
            "like": 83806,
            "created_at": "2019-07-12 09:48:54",
            "updated_at": "2019-07-12 09:48:54",
            "reply": [    // 可以回复评论
                {
                    "id": 342,
                    "user_id": 18,
                    "episode_id": 62,
                    "reply_id": 14,
                    "content": "Illum velit exercitationem vel.",
                    "like": 3903,
                    "created_at": "2019-11-19 14:14:09",
                    "updated_at": "2019-11-19 14:14:09"
                }
            ]
        }
    ],
    "first_page_url": "http://video.test/animes/episode/1/comment?page=1",    // 以下都是用来分页的数据
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://video.test/animes/episode/1/comment?page=1",
    "next_page_url": null,
    "path": "http://video.test/animes/episode/1/comment",
    "per_page": 15,
    "prev_page_url": null,
    "to": 2,
    "total": 2
}
```


### 提交用户评论
请求地址：`/animes/episode/{id}/comment`，`id`是动画某一集的 id  
请求方式：POST  
请求数据：
```
GET /animes/episode/12/comment
{
    "content": "评论的内容",
    "reply_id": "如果是回复某一评论，填写要回复的评论 id"，
}
```
成功返回数据：
```
{
    "content": "评论的内容",
    "user_id": 1,
    "episode_id": 1,
    "updated_at": "2020-03-18 02:58:28",
    "created_at": "2020-03-18 02:58:28",
    "id": 1202
}
```

### 查询某个评论的详情，会返回这个评论的所有回复
请求地址：`/animes/episode/comment/{id}`，`id`是要查询的评论的 id  
请求方式：GET  
请求数据：
```
GET /animes/episode/comment/1
```
成功返回数据：
```
{
    "id": 1,
    "user_id": 16,
    "episode_id": 145,
    "reply_id": null,
    "content": "Nulla omnis et laboriosam cumque eaque beatae non.",
    "like": 870072,
    "created_at": "2019-04-02 19:25:29",
    "updated_at": "2019-04-02 19:25:29",
    "reply": [
        {
            "id": 301,
            "user_id": 5,
            "episode_id": 154,
            "reply_id": 1,
            "content": "Sunt doloribus ipsam vitae voluptatem.",
            "like": 213409310,
            "created_at": "2019-03-29 04:11:33",
            "updated_at": "2019-03-29 04:11:33"
        }
    ]
}
```


### 删除某评论
请求地址：`/animes/episode/comment/{id}`，`id`是要删除的评论的 id  
请求方式：DELETE  
请求数据：
```
DELETE /animes/episode/comment/1
```
成功返回数据：
```
{
    "status": "success",
    "message": "删除成功"，
}
```
备注：如果发不出去 DELETE 请求可以发送 POST 请求，并添加一个 `_method=DELETE` 字段
