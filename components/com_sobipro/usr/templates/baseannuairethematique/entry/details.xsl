<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
<xsl:output method="xml" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" encoding="UTF-8" />

<xsl:include href="../common/topmenu.xsl" />
<xsl:include href="../common/manage.xsl" />
<xsl:include href="../common/alphamenu.xsl" />
<xsl:include href="../common/review.xsl" />

<xsl:template match="/entry_details">
<div itemscope="" itemtype="http://schema.org/LocalBusiness" class="SPDetails">
    
	<div>
      <xsl:apply-templates select="menu" />
      <xsl:apply-templates select="alphaMenu" />
    </div>
  
	<div style="clear:both;"/>
	
	<div class="SPDetailEntry">

		<div class="manage"><xsl:call-template name="manage" /></div>
		<div class="ratingstars"><xsl:call-template name="ratingStars"/></div>
		<div style="clear:both;"/>
		
		<h1 itemprop="legalName" class="SPTitle">
			<xsl:value-of select="entry/name" />
		</h1>
		
		<xsl:if test="count(entry/categories)">
          <div class="spEntryCats">
            <xsl:value-of select="php:function( 'SobiPro::Txt' , 'Catégorie(s):' )" /><xsl:text> </xsl:text>
            <xsl:for-each select="entry/categories/category">
             
              <xsl:value-of select="." />
  
              <xsl:if test="position() != last()">
              <xsl:text> | </xsl:text>
              </xsl:if>
            </xsl:for-each>
          </div>
        </xsl:if>
		
		<div class="spEntryTabs">
		<ul id="tabaccordion">
			<li><span class="tabaccordionitem"><h2><i class="icon-pushpin icon-large"></i> Description</h2></span>
			<section>
				
				<div style="float:left; width:100%;" id="description">
				<div class="block-gauche">	
			
					<div class="spField block-editor" id="resume_activite">
									
						<xsl:value-of select="entry/fields/field_resume_activite/data" disable-output-escaping="yes"/>
						<xsl:text> </xsl:text>
						<xsl:value-of select="entry/fields/field_resume_activite/@suffix"/>
					</div>
					
					<div style="clear:both;"/>
														  
					<div itemprop="description" class="spField block-editor" id="activite_detaillee">
					  <xsl:value-of select="entry/fields/field_activite_detaillee/data" disable-output-escaping="yes"/>
					  <xsl:text> </xsl:text>
					  <xsl:value-of select="entry/fields/field_activite_detaillee/@suffix"/>
					</div>
					
					<xsl:if test="string-length(entry/fields/field_encemoment/data) &gt; 0">
					<div class="SPDE-Encemoment well">
						<strong><xsl:value-of select="entry/fields/field_encemoment/label"/></strong><br/>
						<div itemprop="description" class="spField block-editor" id="activite_detaillee">
						  <xsl:value-of select="entry/fields/field_encemoment/data" disable-output-escaping="yes"/>
						  <xsl:text> </xsl:text>
						  <xsl:value-of select="entry/fields/field_encemoment/@suffix"/>
						</div>
					</div>
					</xsl:if>
					
					<xsl:if test="count(entry/fields/field_a_telecharger/data/*)">
						<div class="spField block" id="download">
							<strong><xsl:value-of select="entry/fields/field_a_telecharger/label"/></strong> : <br/>
							<xsl:copy-of select="entry/fields/field_presentation_a_telecharger/data/*" /><br/>	
							<xsl:copy-of select="entry/fields/field_a_telecharger/data/*" />					
						</div>
					</xsl:if>
			
					<div class="spField block" id="tags">
						<xsl:if test="count(entry/fields/field_tags/data/*)">
							<i class="icon-tags icon-large"></i>						   
							<xsl:text> </xsl:text>
							<xsl:copy-of select="entry/fields/field_tags/data/*" />
						</xsl:if>
					</div>
							
				</div>
				
				<div class="block-droite">
				
				<div class="SPDE-More">
										
					<div class="SPDE-Links">	
						<strong><xsl:text>Suivez-nous sur : </xsl:text></strong><br/>			
						<xsl:if test="string-length(entry/fields/field_facebook/data) &gt; 0">
							
						  <div class="spField" id="facebook">          
						  <a>
							 <xsl:attribute name="href">
							  <xsl:value-of select="entry/fields/field_facebook/data" />
							 </xsl:attribute>
							 <xsl:attribute name="target">
							  <xsl:text>_blank</xsl:text>
							 </xsl:attribute>
							 <i class="icon-facebook-sign"></i>
						  </a>
						  </div>
						  
						</xsl:if>
						<xsl:if test="string-length(entry/fields/field_twitter/data) &gt; 0">
							
						  <div class="spField" id="twitter">          
						  <a>
							 <xsl:attribute name="href">
							  <xsl:value-of select="entry/fields/field_twitter/data" />
							 </xsl:attribute>
							 <xsl:attribute name="target">
							  <xsl:text>_blank</xsl:text>
							 </xsl:attribute>
							 <i class="icon-twitter-sign"></i>
						  </a>
						  </div>
						  
						</xsl:if>
						<xsl:if test="string-length(entry/fields/field_google_plus/data) &gt; 0">
							
						  <div class="spField" id="googleplus">          
						  <a>
							 <xsl:attribute name="href">
							  <xsl:value-of select="entry/fields/field_google_plus/data" />
							 </xsl:attribute>
							 <xsl:attribute name="target">
							  <xsl:text>_blank</xsl:text>
							 </xsl:attribute>
							 <i class="icon-google-plus-sign"></i>
						  </a>
						  </div>
						  
						</xsl:if>
					</div>
				</div>
				
				<xsl:if test="string-length(entry/fields/field_logo/data/@image) &gt; 0">
					<div itemprop="logo" id="logo" class="spField block">
						
						<xsl:element name="img">
						  <xsl:attribute name="src">
						  <xsl:value-of select="entry/fields/field_logo/data/@image" />
						  </xsl:attribute>
						  <xsl:attribute name="alt">
						  <xsl:value-of select="entry/name" />
						  </xsl:attribute>
						</xsl:element>
						
					</div>
				</xsl:if>
				<div class="SPDE-Resume">
					
					
						<xsl:if test="count(entry/fields/field_productions_principales/data/*)">
							<div class="SPField block" id="productions-principales">
								<strong><xsl:value-of select="entry/fields/field_productions_principales/label"/> : </strong><br/>
								<ul>	
								<xsl:for-each select="entry/fields/field_productions_principales/options/*">
								   <xsl:choose>
									  <xsl:when test="./@selected = 'true'">      
										  <li><xsl:value-of select="."/></li>			
									
									  </xsl:when>		 
								   </xsl:choose>
								</xsl:for-each>
								</ul>
							</div>
						</xsl:if>
								
					
						<xsl:if test="count(entry/fields/field_produits_derives/data/*)">
							<div class="SPField block" id="produits-derives">
								<strong><xsl:value-of select="entry/fields/field_produits_derives/label"/> : </strong><br/>
								<ul>
								<xsl:for-each select="entry/fields/field_produits_derives/options/*">
								   <xsl:choose>
									  <xsl:when test="./@selected = 'true'">      
										  <li><xsl:value-of select="."/></li> 
									  </xsl:when>			 
								   </xsl:choose>
								</xsl:for-each>
								</ul>
							</div>
						</xsl:if>
					
				
						<xsl:if test="count(entry/fields/field_bio/data/*)">
							<div class="SPField block" id="caracteritiques">
								<strong><xsl:value-of select="entry/fields/field_bio/label"/> : </strong><br/>
								<ul>	
									
									<xsl:for-each select="entry/fields/field_bio/options/*">
									<xsl:choose>
										<xsl:when test="./@selected = 'true'">
											<li><xsl:value-of select="."/></li>				
										</xsl:when>					 
									</xsl:choose>
									</xsl:for-each>
								</ul>
								
								<div class="stampels">
									<xsl:for-each select="entry/fields/field_bio/options/*">
									<xsl:choose>
										<xsl:when test="./@selected = 'true'">
											<xsl:if test="./@position = 1">	
												<img class="tampon ab" src="images/tampons/logo_ab1-small.jpg" />
											</xsl:if>
										</xsl:when>					 
									</xsl:choose>
									</xsl:for-each>
								</div>
							</div>
						</xsl:if>

					
						<xsl:if test="count(entry/fields/field_services/data/*)">
							<div class="SPField block" id="services">
								<strong><xsl:value-of select="entry/fields/field_services/label"/> : </strong><br/>
								<ul>
								<xsl:for-each select="entry/fields/field_services/options/*">
								   <xsl:choose>
									  <xsl:when test="./@selected = 'true'">      
										  <li><xsl:value-of select="."/></li>		  
									  </xsl:when>			 
								   </xsl:choose>
								</xsl:for-each>
								</ul>
							</div>
						</xsl:if>
				</div>
							
				<div class="SPDE-Galery">
					<div id="spdecarousel" class="carousel slide">
						<div class="carousel-inner">
							<xsl:for-each select="entry/fields/*">
							  <xsl:if test="contains(name(),'field_photo_')">
								  <xsl:if test="string-length(data/@image)">
									  <div itemscope="" itemtype="http://schema.org/ImageObject" class="item">
									   <xsl:element name="img">
									  <xsl:attribute name="src">
									  <xsl:value-of select="data/@image" />
									  </xsl:attribute>
									  <xsl:attribute name="alt">
									  <xsl:value-of select="entry/name" />
									  </xsl:attribute>
									  <xsl:attribute name="itemprop">
									  <xsl:text>contentURL</xsl:text>
									  </xsl:attribute>
									  </xsl:element>
									  </div> 
								  </xsl:if>		  
							  </xsl:if>
							</xsl:for-each>
						</div>
						<a class="carousel-control left" href="#spdecarousel" data-slide="prev"><i class="icon-circle-arrow-left icon-large"></i></a>
						<a class="carousel-control right" href="#spdecarousel" data-slide="next"><i class="icon-circle-arrow-right icon-large"></i></a>
					</div>
				</div>
				
				<div class="SPDE-Socialshare">		
					<strong>Partagez cette fiche : </strong><br/>
					 <div id="entryshareme" data-url="http://sharrre.com/" data-text="Partagez cette fiche sur vos réseaux sociaux favoris">
					 <xsl:attribute name="data-url">
							  <xsl:value-of select="url" />
					</xsl:attribute>
					 </div>
				</div>

				</div>
				</div>
				
				<div style="clear:both;"/>
				
	  
			</section>
			</li>
			
			<li><span class="tabaccordionitem"><h2> <i class="icon-info-sign icon-large"></i> Infos pratiques</h2></span>		
			<section>
				
				<div class="SPDetailEntry-Sidebar">
	  
					<div class="SPDetailEntry-Sidebar-contact">
						<div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress" id="adresse" class="block">
							<strong><xsl:value-of select="entry/name" /></strong>  
							<div itemprop="streetAddress" class="spField">
							  <xsl:value-of select="entry/fields/field_street/data"/>
							  <xsl:text> </xsl:text>
							  <xsl:value-of select="entry/fields/field_street/@suffix"/>
							</div>
							<div itemprop="streetAddress" class="spField">
							  <xsl:value-of select="entry/fields/field_street2/data"/>
							  <xsl:text> </xsl:text>
							  <xsl:value-of select="entry/fields/field_street2/@suffix"/>
							</div>
							<div class="spField">
							  <span itemprop="postalCode">
								  <xsl:value-of select="entry/fields/field_zip/data"/>
								  <xsl:text> </xsl:text>
								  <xsl:value-of select="entry/fields/field_zip/@suffix"/>
							  </span>
							  <span itemprop="addressLocality">
								  <xsl:value-of select="entry/fields/field_city/data"/>
								  <xsl:text> </xsl:text>
								  <xsl:value-of select="entry/fields/field_city/@suffix"/>
							  </span>
							</div>
						</div>
						
						<div class="block" id="telephone">
							<xsl:if test="string-length(entry/fields/field_phone/data) &gt; 0">          
								
								<div itemprop="telephone" class="spField">
									<i class="icon-phone"></i> 
									<xsl:value-of select="entry/fields/field_phone/data"/>
									<xsl:text> </xsl:text>
									<xsl:value-of select="entry/fields/field_phone/@suffix"/>
								</div>
							</xsl:if>
							<xsl:if test="string-length(entry/fields/field_fax/data) &gt; 0">
								
								<div itemprop="faxNumber" class="spField">
									<i class="icon-inbox"></i> 
									<xsl:value-of select="entry/fields/field_fax/data"/>
									<xsl:text> </xsl:text>
									<xsl:value-of select="entry/fields/field_fax/@suffix"/>
								</div>
							</xsl:if>
							<xsl:if test="string-length(entry/fields/field_mobile/data) &gt; 0">
							
							<div class="spField">
								<i class="icon-mobile-phone"></i> 
								<xsl:value-of select="entry/fields/field_mobile/data"/>
								<xsl:text> </xsl:text>
								<xsl:value-of select="entry/fields/field_mobile/@suffix"/>
							</div>
							</xsl:if>
						</div>
							
						<xsl:if test="string-length(entry/fields/field_site_internet/data) &gt; 0">
				  
							<div class="spField block" id="internet"> 
								<i class="icon-plus"></i> 
								<a>
									<xsl:attribute name="href">
									<xsl:value-of select="entry/fields/field_site_internet/data" />
									</xsl:attribute>
									<xsl:attribute name="target">
									<xsl:text>_blank</xsl:text>
									</xsl:attribute>

									<xsl:value-of select="entry/fields/field_site_internet/data" />							 
								</a>
							</div>
					  
						</xsl:if>
						
						<div id="print" class="block">
							<a>
								<xsl:attribute name="href">
									<xsl:text>mailto:</xsl:text>
									<xsl:text>?subject=</xsl:text>
									<xsl:value-of select="entry/name" />
									<xsl:text>&amp;body=</xsl:text>
									<xsl:value-of select="url" />
								</xsl:attribute>
								<i class="icon-envelope"></i> Envoyer cette fiche par mail
							</a>
						</div>
						<div id="print" class="block">
							<a href="#" onClick="window.print()"><i class="icon-print"></i> Imprimer cette fiche</a>
						</div>														
					</div>
		
					<div class="SPDetailEntry-Sidebar-infos">
					
						<xsl:if test="string-length(entry/fields/field_lieux_de_vente/data) &gt; 0">
							<div class="SPField block" id="lieuxdevente">			
								<strong><xsl:text>Lieux de vente : </xsl:text></strong><br/>	
								<ul>
								<xsl:for-each select="entry/fields/field_lieux_de_vente/options/*">
								<xsl:choose>
								  <xsl:when test="./@selected = 'true'">      
									  <li><xsl:value-of select="."/></li>		  
								  </xsl:when>			 
								</xsl:choose>
								</xsl:for-each>
								</ul>
							</div>
						</xsl:if>
						
						<xsl:if test="string-length(entry/fields/field_information_complementaire/data) &gt; 0">
							<div class="SPField block-editor" id="infocomplementaire">			  
							  <div class="spField">
								<xsl:value-of select="entry/fields/field_information_complementaire/data" disable-output-escaping="yes"/>
								<xsl:text> </xsl:text>
								<xsl:value-of select="entry/fields/field_information_complementaire/@suffix"/>
							  </div>
							</div>
						</xsl:if>
						
						
					</div>
				</div>	

				<div style="clear:both;"/>
			
				<div class="SPDE-Map">
					<xsl:text>{mosmap Largeur='100%'|Hauteur='400'|tooltip='</xsl:text>
					<xsl:value-of select="entry/name" /><xsl:text>'|text ='</xsl:text>
					<strong><xsl:value-of select="entry/name" /></strong><br/>
					<xsl:value-of select="entry/fields/field_street/data"/><br/>
					<xsl:value-of select="entry/fields/field_zip/data"/><xsl:text> </xsl:text>
					<xsl:value-of select="entry/fields/field_city/data"/>
					<xsl:text>'|address ='</xsl:text>
					<xsl:value-of select="entry/fields/field_street/data"/><xsl:text>, </xsl:text>
					<xsl:value-of select="entry/fields/field_zip/data"/><xsl:text> </xsl:text>
					<xsl:value-of select="entry/fields/field_city/data"/>
					<xsl:text>' |align='center'}</xsl:text>
					<div class="directions-show closed"><i class="icon-road icon-large"></i><xsl:text> Afficher/masquer les détails de l'itinéraire</xsl:text></div>
				</div>
			</section>
			</li>
			
			<li><span class="tabaccordionitem"><h2><i class="icon-comments icon-large"></i> Commentaires</h2></span>
			<section>	
				<div id="commentaires">
				<xsl:call-template name="ratingSummary"/>
				<xsl:call-template name="reviewForm"/>
				<div style="clear: both;"/><br/>
				<xsl:call-template name="reviews"/>	
				</div>
			</section>
			</li>
			
			<li><span class="tabaccordionitem"> <h2><i class="icon-phone icon-large"></i> Contact</h2></span>
			<section>	 
			  <div id="contact">
				<xsl:call-template name="contact">
						<xsl:with-param name="field" select="/entry_details/entry/fields/field_contact/data"/>
					  </xsl:call-template>  
			  </div>
			</section>
			</li>
		</ul> 
		</div>
		<div style="clear:both;"></div>
	
	</div> <!--container-->
	<div style="clear:both;"></div>
     
</div>

</xsl:template>
</xsl:stylesheet>