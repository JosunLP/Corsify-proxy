<?php


namespace webapp_php_sample_class;

use JetBrains\PhpStorm\ArrayShape;
use JsonException;

class Main
{
	/**
	 * @param $pagePath
	 * @param $pageName
	 * @param $pageMap
	 * @throws JsonException
	 */
	public static function main($pagePath, $pageName, $pageMap): void
    {
        $pageList = json_decode($pageMap, false, 512, JSON_THROW_ON_ERROR);
        echo '<div class="content">';
        foreach ($pageList as $page) {
            if ($page->Name === $pageName && $page->IsSet === true) {
                echo '<h1 class="titleDoc">' . $pageName . '</h1>';
            }
        }

        if ($pagePath !== 'page/open/Home.page.php') {

            $pathParts = explode('/', $pagePath);
            $pathParts[1] = 'static';
            $staticPath = implode('/', $pathParts);
            $openDir = scandir('page/open/');
            $staticDir = scandir('page/static/');
            $openProof = 0;
            $staticProof = 0;

            foreach ($openDir as $openFile) {
                $open = explode('.', $openFile);
                if ($pageName === $open[0]) {
                    $openProof++;
                }
            }
            foreach ($staticDir as $staticFile) {
                $static = explode('.', $staticFile);
                if ($pageName === $static[0]) {
                    $staticProof++;
                }
            }

            if ($openProof > 0) {
                include $pagePath;
            } elseif ($staticProof > 0) {
                include $staticPath;
            }
        } else {
            include 'page/open/Home.page.php';
        }

        echo '</div>';

    }

	/**
	 * @param $pageMap
	 * @param $pageName
	 * @throws JsonException
	 */
	public static function navigation($pageMap, $pageName): void
    {
        $pageList = json_decode($pageMap, false, 512, JSON_THROW_ON_ERROR);
        $pageContainer = [];

        echo "<div class='collapse navbar-collapse' id='navbarSupportedContent'>";
        echo '<ul class="navbar-nav mr-auto">';

        foreach ($pageList as $pageObj) {
            if ($pageObj->Master !== 'null') {
                $pageContainer[] = [$pageObj->Master => $pageObj];
            }
        }

        foreach ($pageList as $pageObj) {
            $active = '';
            $current = '';

            if ($pageName === $pageObj->Name) {
                echo "<span class='sr-only'>(current)</span>";
            }

            if ($pageName === $pageObj->Name) {
                $active = 'active';
            }

            self::createPageEntry($pageObj, $active, $current, $pageContainer);
        }
    }

	/**
	 * @param $pageObj
	 * @param $active
	 * @param $current
	 * @param $pageContainer
	 */
	private static function createPageEntry($pageObj, $active, $current, $pageContainer): void
    {
        $master = null;
        if (array_key_exists($pageObj->Name, $pageContainer[0])) {
            $master = 'dropdown';
        } else {
            $master = 'simple';
        }

        switch ($master) {
            case 'simple':
                if ($pageContainer[0]['Example']->Name !== $pageObj->Name) {
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link ' . $active . " \" href='/" . $pageObj->Name . "' >" . $pageObj->Name . ' ' . $current . '</a>';
                    echo '</li>';
                }
                break;

            case 'dropdown':
                echo '<div class="dropdown nav-item">';
                echo '<div class="btn-group">';
                echo '<a href="/' . $pageObj->Name . '">';
                echo '<button class="btn nav-link"
                            role="button"
                            id="dropdownMenuLink' . $pageObj->Name . '"
                            >' . $pageObj->Name . '</button>';
                echo '</a>';
                echo '<button type="button" class="btn nav-link dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button>';
                echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
                foreach ($pageContainer[0] as $key => $value) {
                    if ($key === $pageObj->Name) {
                        foreach ($value as $item => $tile) {
                            if ($item === 'Name') {
                                echo '<a class="dropdown-item nav-link ' . $active . " \" href='/" . $tile . "' >" . $tile . ' ' . $current . '</a>';
                            }
                        }
                    }
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';
                break;
        }
    }

	/**
	 * @param $pagePath
	 * @return string
	 */
	public static function getPageNameFromPath($pagePath): string
    {
        $parts = explode('/', $pagePath);
        $file = $parts[2];
        $parts = explode('.', $file);
        return $parts[0];
    }

	/**
	 * @param $name
	 * @return string
	 */
	public static function validateHome($name): string
    {
        $open = 'page/open/';
        $static = 'page/static/';
        $fileEnding = '.page.php';
        $pageFiles = scandir($open);
        $pageFilesStatic = scandir($static);
        if ($name === '') {
            return $open . 'Home' . $fileEnding;
        }

        foreach ($pageFiles as $file) {
            $f = explode('.', $file);
            if ($name === $f[0]) {
                return $open . $name . $fileEnding;
            }
        }
        foreach ($pageFilesStatic as $file) {
            $f = explode('.', $file);
            if ($name === $f[0]) {
                return $static . $name . $fileEnding;
            }
        }
        return $static . 'Error_404' . $fileEnding;
    }

	/**
	 * @param $path
	 * @return array[]
	 */
	#[ArrayShape(['page' => "array"])] public static function validateFile($path): array
    {
        $files = array_diff(scandir($path), DEFAULT_FILE_FILTER);

        $i = 0;
        $fileList = array('page' => array());
        foreach ($files as $file) {
            if ($file === NULL) {
                ErrorHandler::FireError('FileError', 'The File check failed');
            } else {
                $fileList['page'][$i] = $path . $file;
            }
            $i++;
        }
        return $fileList;
    }

	/**
	 * @return string
	 */
	public static function getUrlInterpreter(): string
	{
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $page = ucfirst($url[1]);
        if (isset($url[2])) {
            return 'Error_404';
        }

        if ($page === '') {
            return 'Home';
        }

        return $page;
    }

	/**
	 * @param $database_link
	 */
	public static function ipCheck($database_link): void
    {
        $clientIp = self::checkRequest('post', 'ip');
        self::ipPush($database_link, $clientIp);
    }

	/**
	 * @param $mode
	 * @param $key
	 * @return mixed
	 */
	public static function checkRequest($mode, $key): mixed
	{
        switch ($mode) {
            case 'post':
                return $_POST[$key] ?? null;

            case 'get':
                return $_GET[$key] ?? null;
        }

        return null;
    }

	/**
	 * @param $link
	 * @param $clientIp
	 */
	protected static function ipPush($link, $clientIp): void
    {
        $timestamp = date('H:i:s');
        $date = date('Y-m-d');
        $pip = self::getRealIp();
        $info = $_SERVER['HTTP_USER_AGENT'];
        $query = "INSERT INTO iplogg ( info, publicIP, clientIP, TS, DT ) VALUES ( '$info', '$pip', '$clientIp', '$timestamp', '$date');";
        $link->query($query);
    }

	/**
	 * @return string
	 */
	public static function getRealIp(): string
	{
        $ip = 'undefined';
        if (isset($_SERVER)) {
            $ip = $_SERVER['REMOTE_ADDR'];
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        } else {
            $ip = getenv('REMOTE_ADDR');
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $ip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP')) {
                $ip = getenv('HTTP_CLIENT_IP');
            }
        }
		return htmlspecialchars($ip, ENT_QUOTES, 'UTF-8');
    }
}
