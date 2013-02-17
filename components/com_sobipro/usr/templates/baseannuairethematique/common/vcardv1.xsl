<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
<xsl:import href="review.xsl" />
<xsl:output method="xml" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" encoding="UTF-8"/>

  <xsl:template name="vcard">
  
  <xsl:if test="string-length(fields/field_logo/data/@image) &gt; 0">
		<div id="logo" class="SPField pull-left">
			
			<xsl:element name="img">
			  <xsl:attribute name="src">
			  <xsl:value-of select="fields/field_logo/data/@thumbnail" />
			  </xsl:attribute>
			  <xsl:attribute name="alt">
			  <xsl:value-of select="entry/name" />
			  </xsl:attribute>
			</xsl:element>
			
		</div>
	</xsl:if>
    
	<div class="spEntriesListTitle">

	<div class="spField" id="fichedetaillee">
			<a>
				<xsl:attribute name="href">
				  <xsl:value-of select="url" />
				</xsl:attribute>
			  
				<i class="icon-plus-sign"></i><xsl:text> </xsl:text><xsl:value-of select="php:function( 'SobiPro::Txt' , 'Fiche détaillée' )" />
			</a>
		 </div>  

	</div>

	<div class="spField" id="resume_activite">

		<xsl:value-of select="fields/field_resume_activite/data" disable-output-escaping="yes"/>
		<xsl:text> </xsl:text>
		<xsl:value-of select="fields/field_resume_activite/@suffix"/>
	
    </div>    
	
	<xsl:if test="string-length(fields/field_lieux_de_vente/data) &gt; 0">
		<div class="spField block" id="lieuxdevente">			
			<strong><xsl:value-of select="fields/field_lieux_de_vente/label" /> :</strong><br/>
			<ul style="display:inline">
			<xsl:for-each select="fields/field_lieux_de_vente/options/*">
			<xsl:choose>
			  <xsl:when test="./@selected = 'true'">      
				  <li><xsl:value-of select="."/></li>		  
			  </xsl:when>			 
			</xsl:choose>
			</xsl:for-each>
			</ul>
		</div>
	</xsl:if>
	
	<div style="clear:both;"/>
	
	<xsl:if test="string-length(fields/field_productions_principales/data) &gt; 0">
		<div class="spField block" id="productionsprincipales">
			<strong><xsl:value-of select="fields/field_productions_principales/label" /> :</strong><br/>
			<ul>
				<xsl:for-each select="fields/field_productions_principales/options/*">
				   <xsl:choose>
					  <xsl:when test="./@selected = 'true'">      
						  <li><xsl:value-of select="."/></li>			
					  </xsl:when>		 
				   </xsl:choose>
				</xsl:for-each>
			</ul>
		</div>
		<div style="clear:both;"/>
	</xsl:if>
	
	<xsl:if test="string-length(fields/field_produits_derives/data) &gt; 0">
		<div class="spField block" id="produitsderives">
			<strong><xsl:value-of select="fields/field_produits_derives/label" /> :</strong><br/>
			<ul>
				<xsl:for-each select="fields/field_produits_derives/options/*">
				   <xsl:choose>
					  <xsl:when test="./@selected = 'true'">      
						  <li><xsl:value-of select="."/></li>		  
					  </xsl:when>			 
				   </xsl:choose>
				</xsl:for-each>
			</ul>
		</div>
		<div style="clear:both;"/>
	</xsl:if>
	
	<xsl:if test="string-length(fields/field_bio/data) &gt; 0">
		<div class="spField block" id="caracteristiques">
			<strong><xsl:value-of select="fields/field_bio/label" /> :</strong><br/>
			<ul>
				<xsl:for-each select="fields/field_bio/options/*">
				   <xsl:choose>
					  <xsl:when test="./@selected = 'true'">      
						  <li><xsl:value-of select="."/></li>
					  </xsl:when>			 
				   </xsl:choose>
				</xsl:for-each>
			</ul>
		</div> 
		<div style="clear:both;"/>	
	</xsl:if>
	
	<xsl:if test="string-length(fields/field_services/data) &gt; 0">
		<div class="spField block" id="services">
			<strong><xsl:value-of select="fields/field_services/label" /> :</strong><br/>
			<ul>
				<xsl:for-each select="fields/field_services/options/*">
				   <xsl:choose>
					  <xsl:when test="./@selected = 'true'">      
						  <li><xsl:value-of select="."/></li>
					  </xsl:when>			 
				   </xsl:choose>
				</xsl:for-each>
			</ul>
		</div> 
		<div style="clear:both;"/>   
	</xsl:if>
	
  </xsl:template>
</xsl:stylesheet>
