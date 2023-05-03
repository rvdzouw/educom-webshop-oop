<?php
    require_once 'product_doc.php';

    class DetailDoc extends ProductsDoc {

        protected function showHeader(){
            echo 'Detailpagina';
        }


        protected function showContent() {
            $options = array();
            $flavour["price"] = 0;
            $product = doesProductExist($id, $size, $material);
            $product['amount'] = 1;
            if (!$product){
                echo "Product bestaat niet (meer)";
                return;
            }
            $flavour = null;
            if (array_key_exists($priceId, $product['flavours'])) {
                $flavour = $product['flavours'][$priceId];
                if ($flavour['size_id'] != $size || $flavour['material_id']!=$material) {
                    $flavour=null;
                }
            } 
            if (empty($flavour)) {
                foreach ($product['flavours'] as $flav)  {
                    if ($flav['size_id'] == $size && $flav['material_id']==$material) {
                        $flavour = $flav;
                        break;
                    }
                }
            }
            if (empty($flavour)) {
                $price_id = key($product['flavours']);
                $flavour = $product['flavours'][$price_id];
            }
            $product['size']=$product['material']=generateKey($id, $flavour);
            echo '<div class="productheader">
                    <h1>' . $product["name"] . '</h1>
                  </div>';
            echo '<div class=imgdetail>
                    <img src="Images/' . $product["image"] . '" alt="' . $product["name"] . '" class="detail">
                  </div>';
            echo '<div class="productprice">
                    <h2>&#8364;' . $flavour["price"] . '</h2>';
            $sizeOptions = array();
            $materialOptions = array();
            foreach ($product['flavours'] as $flav)  {
                $flav_key = generateKey($id, $flav);
                if ($flav['size_id'] == $size) {
                    $materialOptions[$flav_key] = "Materiaal: " . $flav["material"];
                }
                if ($flav['material_id'] == $material) {
                    $sizeOptions[$flav_key] = "Maat: " . $flav['size']; 
                }
            }
            $onChange="window.location=makeDetailLink(this.value)";
            $this->showFormStart('product');
            $this->showFormField('flavour', 'Maat:', 'select', $product, $sizeOptions, null, null, $onChange);
            $this->showFormField('material', 'Materiaal', 'select', $product, $materialOptions, null, null, $onChange);
            $this->showFormEnd('detail');
                showFormField('amount', 'Aantal', 'number', $product , $options , 1, 99, NULL);
                echo '<br>';
                showFormButton("Toevoegen", "action");
                showFormEnd("detail");
                echo '<br>';  
            
            echo '<div class="descriptionheader">';
            echo '<h3>Productomschrijving</h3>';
            echo '<div class="description">';
            echo  $product["description"];
            echo '</div>';
            echo '<div class="properties">';
            echo '<h4>Producteigenschappen</h4>';
            echo '<ul>';
            foreach ($product['properties'] as $properties) {
                echo '<li>' . $properties["name"] .": " . $properties['value'] . ' ' . $properties['unit'] . '</li>';
            }
        }
    }
?>