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
	
		<div class="taa-tabs minimal hide-title cross-fade">
			<section>
			
				<h2><i class="icon-pushpin icon-large"></i> Description</h2>
				
				<div class="spField" id="title">
				  <xsl:value-of select="entry/fields/field_title/data"/>
				  <xsl:text> </xsl:text>
				  <xsl:value-of select="entry/fields/field_title/@suffix"/>
				</div>  
								  
				<div class="spField" id="resume_activite">
					<xsl:value-of select="entry/fields/field_resume_activite/data" disable-output-escaping="yes"/>
					<xsl:text> </xsl:text>
					<xsl:value-of select="entry/fields/field_resume_activite/@suffix"/>
				</div>
				
	
				<xsl:if test="string-length(data/@image)">
					<div itemprop="logo" class="SPDE-Logo hidden-phone">
						
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
		  
				<div itemprop="description" class="spField" id="activite_detaillee">
				  <xsl:value-of select="entry/fields/field_activite_detaillee/data" disable-output-escaping="yes"/>
				  <xsl:text> </xsl:text>
				  <xsl:value-of select="entry/fields/field_activite_detaillee/@suffix"/>
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
				
				<div class="SPDE-Resume">
									
					<strong><xsl:text>Productions principales : </xsl:text></strong><br/>						
					<xsl:for-each select="entry/fields/field_productions_principales/options/*">
					   <xsl:choose>
						  <xsl:when test="./@selected = 'true'">      
							  <xsl:value-of select="."/>				
							  <xsl:text>, </xsl:text>

						  </xsl:when>		 
					   </xsl:choose>
					</xsl:for-each>
					
					<div style="clear:both;"/>
					<strong><xsl:text>Produits dérivés : </xsl:text></strong><br/>	
					<xsl:for-each select="entry/fields/field_produits_derives/options/*">
					   <xsl:choose>
						  <xsl:when test="./@selected = 'true'">      
							  <xsl:value-of select="."/>
								<xsl:text>, </xsl:text>				  
						  </xsl:when>			 
					   </xsl:choose>
					</xsl:for-each>
		
					<div style="clear:both;"/>
					
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
	 
				<div class="SPDE-More">
					
						
					<div class="SPDE-Links">	
						<strong><xsl:text>Suivez-nous sur : </xsl:text></strong><br/>			
						<xsl:if test="string-length(entry/fields/field_facebook/data) &gt; 0">
							
						  <div class="spField" id="facebook">          
						  <a>
							 <xsl:attribute name="href">
							  <xsl:value-of select="entry/fields/field_facebook/data/a/@href" />
							 </xsl:attribute>
							 <xsl:attribute name="target">
							  <xsl:value-of select="_blank" />
							 </xsl:attribute>
							 <i class="icon-facebook-sign"></i>
						  </a>
						  </div>
						  
						</xsl:if>
						<xsl:if test="string-length(entry/fields/field_twitter/data) &gt; 0">
							
						  <div class="spField" id="twitter">          
						  <a>
							 <xsl:attribute name="href">
							  <xsl:value-of select="entry/fields/field_twitter/data/a/@href" />
							 </xsl:attribute>
							 <xsl:attribute name="target">
							  <xsl:value-of select="_blank" />
							 </xsl:attribute>
							 <i class="icon-twitter-sign"></i>
						  </a>
						  </div>
						  
						</xsl:if>
						<xsl:if test="string-length(entry/fields/field_googleplus/data) &gt; 0">
							
						  <div class="spField" id="googleplus">          
						  <a>
							 <xsl:attribute name="href">
							  <xsl:value-of select="entry/fields/field_googleplus/data/a/@href" />
							 </xsl:attribute>
							 <xsl:attribute name="target">
							  <xsl:value-of select="_blank" />
							 </xsl:attribute>
							 <i class="icon-google-plus-sign"></i>
						  </a>
						  </div>
						  
						</xsl:if>
					</div>
				</div>

				
				
				<div style="clear:both;"/>
					
				<div class="SPDE-Tags">
					<xsl:if test="count(entry/fields/field_tags/data/*)">
						<i class="icon-tags icon-large"></i>						   
						<xsl:text> </xsl:text>
						<xsl:copy-of select="entry/fields/field_tags/data/*" />
					</xsl:if>
				</div>
				
	  
			</section>
			<section>
				<h2> <i class="icon-info-sign icon-large"></i> Infos pratiques</h2>  
		
				<div class="SPDetailEntry-Sidebar">
	  
					<div class="SPDetailEntry-Sidebar-contact">
						<div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress" class="SPDetailEntry-Sidebar-address">
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
						
						<div class="SPDetailEntry-Sidebar-telephone">
							<xsl:if test="string-length(entry/fields/field_phone/data) &gt; 0">          
								
								<div itemprop="telephone" class="spField">
									<strong><xsl:value-of select="entry/fields/field_phone/label" />: </strong>
									<xsl:value-of select="entry/fields/field_phone/data"/>
									<xsl:text> </xsl:text>
									<xsl:value-of select="entry/fields/field_phone/@suffix"/>
								</div>
							</xsl:if>
							<xsl:if test="string-length(entry/fields/field_fax/data) &gt; 0">
								
								<div itemprop="faxNumber" class="spField">
									<strong><xsl:value-of select="entry/fields/field_fax/label" />: </strong>
									<xsl:value-of select="entry/fields/field_fax/data"/>
									<xsl:text> </xsl:text>
									<xsl:value-of select="entry/fields/field_fax/@suffix"/>
								</div>
							</xsl:if>
							<xsl:if test="string-length(entry/fields/field_mobile/data) &gt; 0">
							
							<div class="spField">
								<strong><xsl:value-of select="entry/fields/field_mobile/label" />: </strong>
								<xsl:value-of select="entry/fields/field_mobile/data"/>
								<xsl:text> </xsl:text>
								<xsl:value-of select="entry/fields/field_mobile/@suffix"/>
							</div>
							</xsl:if>
						</div>
								
					</div>
		
					<div class="SPDetailEntry-Sidebar-infos">
						
						<xsl:if test="string-length(entry/fields/field_horaires_ouverture/data) &gt; 0">
							<div class="SPDetailEntry-Sidebar-horaires">			  
							  <strong><xsl:value-of select="entry/fields/field_horaires_ouverture/label" />: </strong>
							  <div class="spField">
								<xsl:value-of select="entry/fields/field_horaires_ouverture/data" disable-output-escaping="yes"/>
								<xsl:text> </xsl:text>
								<xsl:value-of select="entry/fields/field_horaires_ouverture/@suffix"/>
							  </div>
							</div>
						</xsl:if>
						
						<span class="spField" id="bio">
							<xsl:for-each select="entry/fields/field_recuperation_essaims/options/*">
							   <xsl:choose>
								  <xsl:when test="./@selected = 'true'">      
									  <xsl:value-of select="."/>
									  <xsl:text>.</xsl:text>						  
								  </xsl:when>			 
							   </xsl:choose>
							</xsl:for-each>
						</span>	
						
						<xsl:if test="string-length(entry/fields/field_site_internet/data) &gt; 0">
					  
							<div class="spField" id="internet"> 
								<strong><xsl:text>Site internet : </xsl:text></strong>
								<a>
									<xsl:attribute name="href">
									<xsl:value-of select="entry/fields/field_site_internet/data/a/@href" />
									</xsl:attribute>
									<xsl:attribute name="target">
									<xsl:text>_blank</xsl:text>
									</xsl:attribute>

									<xsl:value-of select="entry/fields/field_site_internet/data/a/@href" />							 
								</a>
							</div>
					  
						</xsl:if>
						
						<div id="print" class="hidden-phone">
							<a href="#" onClick="window.print()"><i class="icon-print"></i> Imprimer cette fiche</a>
						</div>
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
			<section>
				<h2><i class="icon-comments icon-large"></i> Commentaires</h2>
				<xsl:call-template name="ratingSummary"/>
				<xsl:call-template name="reviewForm"/>
				<div style="clear: both;"/><br/>
				<xsl:call-template name="reviews"/>		  
			</section>
			<section>
			  <h2><i class="icon-phone icon-large"></i> Contact</h2>
			  <div id='contact'>
				<xsl:call-template name="contact">
						<xsl:with-param name="field" select="/entry_details/entry/fields/field_contact/data"/>
					  </xsl:call-template>  
			  </div>
			</section>
		 
		</div> <!--tabs-->

	   {loadposition social}
		
	</div> <!--container-->
	<div style="clear:both;"></div>
     
</div>

</xsl:template>
</xsl:stylesheet>