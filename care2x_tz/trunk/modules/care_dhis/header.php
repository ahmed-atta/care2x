<?
fwrite($fp,"<?xml version='1.0'?>");
            fwrite($fp,"<dxf>");
                fwrite($fp,"<categoryOptions>");
                    fwrite($fp,"<categoryOption>");
                        fwrite($fp,"<id>1</id>");
                        fwrite($fp,"<name>default</name>");
                    fwrite($fp,"</categoryOption>");
                fwrite($fp,"</categoryOptions>");
                fwrite($fp,"<categories>");
                    fwrite($fp,"<category>");
                        fwrite($fp,"<id>2</id>");
                        fwrite($fp,"<name>default</name>");
                    fwrite($fp,"</category>");
                fwrite($fp,"</categories>");
                fwrite($fp,"<categoryCombos>");
                    fwrite($fp,"<categoryCombo>");
                        fwrite($fp,"<id>3</id>");
                        fwrite($fp,"<name>default</name>");
                    fwrite($fp,"</categoryCombo>");
                fwrite($fp,"</categoryCombos>");
                fwrite($fp,"<categoryOptionCombos>");
                    fwrite($fp,"<categoryOptionCombo>");
                        fwrite($fp,"<id>4</id>");
                        fwrite($fp,"<categoryCombo>");
                            fwrite($fp,"<id>3</id>");
                            fwrite($fp,"<name>default</name>");
                        fwrite($fp,"</categoryCombo>");
                        fwrite($fp,"<categoryOptions>");
                            fwrite($fp,"<categoryOption>");
                                fwrite($fp,"<id>1</id>");
                                fwrite($fp,"<name>default</name>");
                            fwrite($fp,"</categoryOption>");
                        fwrite($fp,"</categoryOptions>");
                    fwrite($fp,"</categoryOptionCombo>");
                fwrite($fp,"</categoryOptionCombos>");
                fwrite($fp,"<categoryCategoryOptionAssociations>");
                    fwrite($fp,"<categoryCategoryOptionAssociation>");
                        fwrite($fp,"<category>2</category>");
                        fwrite($fp,"<categoryOption>1</categoryOption>");
                    fwrite($fp,"</categoryCategoryOptionAssociation>");
                fwrite($fp,"</categoryCategoryOptionAssociations>");
                fwrite($fp,"<categoryComboCategoryAssociations>");
                    fwrite($fp,"<categoryComboCategoryAssociation>");
                        fwrite($fp,"<categoryCombo>3</categoryCombo>");
                        fwrite($fp,"<category>2</category>");
                    fwrite($fp,"</categoryComboCategoryAssociation>");
                fwrite($fp,"</categoryComboCategoryAssociations>");
?>