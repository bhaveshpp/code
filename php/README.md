# CODE

### Most Recently used

generate download file

```
            $file = "/home/ns3090620/public_html/var/tmp/test.pdf";
            $txt = fopen($file, "w") or die("Unable to open file!");
            fwrite($txt, $pdfFileData['filestream']);
            fclose($txt);
            
            header('Content-Description: File Transfer');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            header("Content-Type: text/plain");
            readfile($file);
```
