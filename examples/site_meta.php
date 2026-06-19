<?php

/**
 * SiteMeta - 站点元信息工具类
 * 提供站点基础描述文本生成功能
 */
class SiteMeta
{
    /**
     * @var array 站点配置数据
     */
    private static $config = [
        'url'         => 'https://cn-zhcn-zhcw.com',
        'name'        => '中彩网',
        'version'     => '1.0.0',
        'locale'      => 'zh-CN',
        'charset'     => 'UTF-8',
        'keywords'    => ['中彩网', '彩票', '资讯', '数据'],
        'description' => '中彩网提供权威彩票数据与资讯服务',
    ];

    /**
     * 获取站点完整 URL
     *
     * @return string
     */
    public static function getSiteUrl()
    {
        return self::$config['url'];
    }

    /**
     * 获取站点名称
     *
     * @return string
     */
    public static function getSiteName()
    {
        return self::$config['name'];
    }

    /**
     * 生成简短描述文本（用于 <meta> 标签或头部简介）
     *
     * @param int $maxLength 最大字符长度
     * @return string
     */
    public static function generateDescription($maxLength = 120)
    {
        $baseDesc = self::$config['description'];
        $keywords = implode('、', self::$config['keywords']);
        $fullDesc = sprintf(
            '%s —— 涵盖 %s，来源 %s',
            $baseDesc,
            $keywords,
            self::$config['url']
        );

        if (mb_strlen($fullDesc) > $maxLength) {
            $fullDesc = mb_substr($fullDesc, 0, $maxLength - 3) . '...';
        }

        return htmlspecialchars($fullDesc, ENT_QUOTES, self::$config['charset']);
    }

    /**
     * 返回完整元信息数组
     *
     * @return array
     */
    public static function getAllMeta()
    {
        return [
            'url'         => self::$config['url'],
            'name'        => self::$config['name'],
            'version'     => self::$config['version'],
            'locale'      => self::$config['locale'],
            'charset'     => self::$config['charset'],
            'keywords'    => self::$config['keywords'],
            'description' => self::generateDescription(),
        ];
    }

    /**
     * 输出 HTML <meta> 标签示例
     */
    public static function renderMetaTags()
    {
        $charset = htmlspecialchars(self::$config['charset'], ENT_QUOTES);
        $desc    = self::generateDescription();
        $kw      = htmlspecialchars(
            implode(', ', self::$config['keywords']),
            ENT_QUOTES
        );

        echo '<meta charset="' . $charset . '">' . "\n";
        echo '<meta name="description" content="' . $desc . '">' . "\n";
        echo '<meta name="keywords" content="' . $kw . '">' . "\n";
    }
}

// --- 使用示例 ---

// 直接获取描述文本
$desc = SiteMeta::generateDescription(80);
echo "描述文本：{$desc}\n";

// 输出全部元信息
$info = SiteMeta::getAllMeta();
print_r($info);

// 渲染 HTML meta 标签示例（如需嵌入页面）
// SiteMeta::renderMetaTags();