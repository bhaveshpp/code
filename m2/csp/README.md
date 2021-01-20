## MAGENTO 2 CSP Module

File `config.xml`

```
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Store:etc/config.xsd">
    <default>
        <csp>
            <mode>
                <storefront>
                    <report_only>0</report_only>
                </storefront>
                <admin>
                    <report_only>0</report_only>
                </admin>
            </mode>
        </csp>
    </default>
</config>
```

for other protocal

`<value id="vsbtawk" type="host">wss://*.tawk.to</value>`


File  `csp_whitelist.xml`

```
<?xml version="1.0"?>
<csp_whitelist xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Csp/etc/csp_whitelist.xsd">
    <policies>
        <policy id="script-src">
            <values>
                <!--CDN-->
                <value id="cloudflare" type="host">*.cloudflare.com</value>

                <!--Google-->
                <value id="google-analytics" type="host">www.google-analytics.com</value>

                <!--Functions-->
                <value id="trustedshops" type="host">*.trustedshops.com</value>

                <value id="avis-verifies" type="host">*.avis-verifies.com</value>
                <value id="googleadservices" type="host">*.googleadservices.com</value>
                <value id="paypalobjects" type="host">*.paypalobjects.com</value>
                <value id="paypal" type="host">*.paypal.com</value>
                <value id="gstatic" type="host">*.gstatic.com</value>
                <value id="google" type="host">*.google.com</value>
                <value id="yotpo" type="host">*.yotpo.com</value>
                
                <!-- Additional -->
                <value id="tawk" type="host">*.tawk.to</value>
                <value id="addthis" type="host">*.addthis.com</value>
                <value id="moatads" type="host">*.moatads.com</value>
                <value id="addthisedge" type="host">*.addthisedge.com</value>
                
                <!--tawk.to-->
                <value id="jsdelivr" type="host">*.jsdelivr.net</value>

            </values>
        </policy>
        <policy id="style-src">
            <values>
                <!--CDN-->
                <value id="cloudflare" type="host">*.cloudflare.com</value>

                <!--Design-->
                <value id="typekit" type="host">*.typekit.net</value>

                <!--Functions-->
                <value id="trustedshops" type="host">*.trustedshops.com</value>
                <value id="usercentrics" type="host">*.usercentrics.eu</value>
                <value id="getfirebug" type="host">*.getfirebug.com</value>
                <value id="gstatic" type="host">*.gstatic.com</value>
                <value id="googleapis" type="host">*.googleapis.com</value>
                
                <!--tawk.to-->
                <value id="jsdelivr" type="host">*.jsdelivr.net</value>
            </values>
        </policy>
        <policy id="img-src">
            <values>
                <!--CDN-->
                
                <value id="google-com" type="host">*.google.com</value>
                <value id="google-co-in" type="host">*.google.co.in</value>
                <value id="cloudflare" type="host">*.cloudflare.com</value>
                <value id="cloudfront" type="host">*.cloudfront.net</value>
                <value id="klarna-base" type="host">*.klarna.com</value>
                <value id="yotpo" type="host">*.yotpo.com</value>
                <value id="avis-verifies" type="host">*.avis-verifies.com</value>
                

                <!--Payments-->
                <value id="paypal" type="host">*.paypal.com</value>
                <value id="googleadservices" type="host">*.googleadservices.com</value>                
                <value id="google-analytics" type="host">*.google-analytics.com</value>

                <!--Video-->
                <value id="vimeocdn" type="host">*.vimeocdn.com</value>
                <value id="youtube-img" type="host">*.ytimg.com</value>

                <!--Functions-->
                <value id="data" type="host">'self' data:</value>
                <value id="usercentrics" type="host">*.usercentrics.eu</value>
                
                <!--tawk.to-->
                <value id="tawk" type="host">*.tawk.to</value>
                <value id="jsdelivr" type="host">*.jsdelivr.net</value>
            </values>
        </policy>
        <policy id="connect-src">
            <values>
                <!--CDN-->
                <value id="cloudflare" type="host">*.cloudflare.com</value>

                <!--Payments-->
                <value id="paypal" type="host">*.paypal.com</value>
                <!-- google -->
                <value id="google-analytics" type="host">*.google-analytics.com</value>
                <value id="doubleclick" type="host">*.doubleclick.net</value>
                
                <value id="addthis" type="host">*.addthis.com</value>
                <value id="tawk" type="host">*.tawk.to</value>
                <value id="vsbtawk" type="host">wss://*.tawk.to</value>
                
                <value id="data" type="host">'self' data:</value>
                
            </values>
        </policy>
        <policy id="font-src">
            <values>
                <!--CDN-->
                <value id="cloudflare" type="host">*.cloudflare.com</value>

                <!--Design-->
                <value id="typekit" type="host">*.typekit.net</value>

                <!--Functions-->
                <value id="trustedshops" type="host">*.trustedshops.com</value>
                <value id="bootstrapcdn" type="host">*.bootstrapcdn.com</value>
                <value id="gstatic" type="host">*.gstatic.com</value>
                <value id="data" type="host">'self' data:</value>
                
                <!--tawk.to-->
                <value id="tawk" type="host">*.tawk.to</value>
                
            </values>
        </policy>
        <policy id="frame-src">
            <values>
                <value id="addthis" type="host">*.addthis.com</value>
                
            </values>
        </policy>
    </policies>
</csp_whitelist>
```
