<?php

// This file requires phpLeague's commonmark library to be included for use.

require 'vendor/autoload.php';

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;

use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Parser\MarkdownParser;
use League\CommonMark\Renderer\HtmlRenderer;

use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Node\Block\Paragraph;
use League\CommonMark\TightBlockInterface;

use League\CommonMark\Node\NodeIterator;
use League\CommonMark\Node\StringContainerInterface;
use League\CommonMark\Util\Xml;
use League\CommonMark\Xml\XmlNodeRendererInterface;

class NewFencedCodeRenderer implements NodeRendererInterface
{
    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        FencedCode::assertInstanceOf($node);

        $attrs = $node->data->getData('attributes');
        $iframe_attrs = ['frameborder'=>'0','style'=>'width:100%;overflow:scroll;'];
        $infoWords = $node->getInfoWords();
        if (\count($infoWords) !== 0 && $infoWords[0] !== '') {
            $height = $infoWords[0];
            $iframe_attrs['max-height'] = $height;
            $iframe_attrs['style'] = $iframe_attrs['style']."max-height:".$height."px;";
        }

        $content = Xml::escape($node->getLiteral());
        $code = new HtmlElement('code',['class'=>'iframe','style'=>'font-size:14px'],"\n".$content);
        $pre = new HtmlElement('pre',$attrs->export(),$code);
        $body = new HtmlElement('body',[],$pre);
        $link = new HtmlElement('link',['rel'=>'stylesheet','href'=>$GLOBALS['relative_path'].'style.css']);
        $head = new HtmlElement('head',[],$link);
        $htmldoc= new HtmlElement('html', [], [$head,$body]);
        $iframe_attrs['srcdoc'] = (string)$htmldoc;
        $iframe = new HtmlElement('iframe', $iframe_attrs,' ');
        $figure = new HtmlElement('figure', ['class'=>'code-figure'], $iframe);
        return $figure;
    }
}

class NewCodeRenderer implements NodeRendererInterface{
    public function render(Node $node, ChildNodeRendererInterface $childRenderer){

        Code::assertInstanceOf($node);

        $attrs = $node->data->get('attributes');
        $attrs['style'] = "background-color:#F7F7F7";
        return new HtmlElement('code', $attrs, Xml::escape($node->getLiteral()));

    }
}

class NewImageRenderer implements NodeRendererInterface
{
    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        $attrs = $node->data->get('attributes');

        $attrs['src'] = $node->getUrl();

        if($attrs['src'][strlen($attrs['src'])-4] == "."){
            $extension = substr($attrs['src'],strlen($attrs['src'])-3);
        }else if($attrs['src'][strlen($attrs['src'])-5] == "."){
            $extension = substr($attrs['src'],strlen($attrs['src'])-4);
        }else{
            $extension = "";
        }

        $alt_str = $this->getAltText($node);
        if(str_contains($alt_str,"{")){
            $first = strpos($alt_str,"{");
            $second = strpos($alt_str,"}");
            $container_class = substr($alt_str,$first+1,($second-1)-$first);
            $attrs['alt'] = substr($alt_str,0,$first);
        }else{
            $attrs['alt'] = $this->getAltText($node);
        }

        $children = array();
        if (($title = $node->getTitle()) !== null) {
            $environment = new Environment();
            $environment->addExtension(new CommonMarkCoreExtension());
            $parser = new MarkdownParser($environment);
            $htmlRenderer = new HtmlRenderer($environment);

            $document = $parser->parse($title);
            $title = $htmlRenderer->renderDocument($document);

            $figcaption_contents = $title;
            $figcaption = new HtmlElement('figcaption', [], $figcaption_contents);
            array_push($children,$figcaption);
        }

        if(strlen($extension) > 0 && ($extension == "mkv")){
            $source = new HTMLElement('source',['src'=>$attrs['src']],'',true);
            $video = new HTMLElement('video',['style'=>'width:100%','controls'=>'true'],$source);
            $figure_content = $video;
            $anchor_switch = false;
        }else{
            $img = new HtmlElement('img', $attrs, '', true);
            $figure_content = $img;
            $anchor_switch = true;
        }

        array_push($children,$figure_content);
        $children = array_reverse($children);
        $figure = new HTMLElement('figure', [], $children);

        if($anchor_switch == true){
            $anchor = new HTMLElement('a',['href'=>$node->getUrl(), "target"=>"_blank"], $figure);
        }else{
            $anchor = $figure;
        }

        if(isset($container_class)){
            return new HTMLElement('div',['class'=>$container_class],$anchor);
        }else{
            return $anchor;
        }
    }

    private function getAltText(Image $node): string
    {
        $altText = '';

        foreach ((new NodeIterator($node)) as $n) {
            if ($n instanceof StringContainerInterface) {
                $altText .= $n->getLiteral();
            } elseif ($n instanceof Newline) {
                $altText .= "\n";
            }
        }

        return $altText;
    }
}

class NewParagraphRenderer implements NodeRendererInterface
{
    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        Paragraph::assertInstanceOf($node);

        if ($this->inTightList($node)){
            return $childRenderer->renderNodes($node->children());
        }

        $attrs = $node->data->get('attributes');

        $children = $node->children();
        if( (count($children) == 1) && $children[0] instanceof Image){
            return $childRenderer->renderNodes($node->children());
        }else{
            return new HtmlElement('p', $attrs, $childRenderer->renderNodes($node->children()));
        }
    }

    private function inTightList(Paragraph $node): bool
    {
        $i = 2;
        while (($node = $node->parent()) && $i--){
            if ($node instanceof TightBlockInterface){
                return $node->isTight();
            }
        }
        return false;
    }
}

$environment = new Environment();
$environment->addExtension(new CommonMarkCoreExtension());
$environment->addRenderer(Code::class, new NewCodeRenderer());
$environment->addRenderer(FencedCode::class, new NewFencedCodeRenderer());
$environment->addRenderer(Image::class, new NewImageRenderer());
$environment->addRenderer(Paragraph::class, new NewParagraphRenderer());
$parser = new MarkdownParser($environment);
$htmlRenderer = new HtmlRenderer($environment);

if(isset($file_ref)){
    $markdown_file = fopen($file_ref,"r");
    $markdown = fread($markdown_file,filesize($file_ref));
    fclose($markdown_file);
    $document = $parser->parse($markdown);
    echo $htmlRenderer->renderDocument($document);
}

?>
