## MAGENTO 2 SET AND GET COOKIE

### Use Object Manager

```
$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$cookie = $objectManager->get(\Magento\Framework\Stdlib\Cookie\PhpCookieManager::class);
$cookieMeta = $objectManager->get(\Magento\Framework\Stdlib\Cookie\PublicCookieMetadata::class);

$rUrl = $this->urlBuilder->getCurrentUrl();
$cookieMeta->setDurationOneYear();
$cookieMeta->setPath('/');
$cookieMeta->setHttpOnly(false);

/* Set Cookie */
$cookie->setPublicCookie('previous_redirect_url1',$rUrl,$cookieMeta); 
/* Get Cookie */
$cookie->getCookie('previous_redirect_url');

```

### Use Dependency Injection

Inject Object

```
use Magento\Framework\Stdlib\Cookie\PhpCookieManager;
use Magento\Framework\Stdlib\Cookie\PublicCookieMetadata;

```

Define Variables

```
    /**
     * @var PhpCookieManager
     */
    public $cookie;
    /**
     * @var PublicCookieMetadata
     */
    public $cookieMeta;

```

Pass to costructor

```
        PhpCookieManager $cookie,
        PublicCookieMetadata $cookieMeta
```

Assign Variable

```
        $this->cookie = $cookie;    
        $this->cookieMeta = $cookieMeta;
```

Use Object 

```
            $rUrl = $this->urlBuilder->getCurrentUrl();
            $this->cookieMeta->setDurationOneYear();
            $this->cookieMeta->setPath('/');
            $this->cookieMeta->setHttpOnly(false);
            
            /* Set Cookie */
            $this->cookie->setPublicCookie('previous_redirect_url1',$rUrl,$this->cookieMeta); 
            /* Get Cookie */
            $this->cookie->getCookie('previous_redirect_url');
            /* Delete Cookie */
            $this->cookie->deleteCookie('previous_redirect_url');
```
