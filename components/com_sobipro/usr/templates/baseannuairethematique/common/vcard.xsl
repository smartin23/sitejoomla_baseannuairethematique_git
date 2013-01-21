<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
<xsl:import href="review.xsl" />
<xsl:output method="xml" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" encoding="UTF-8"/>

  <xsl:template name="vcard">
    <span class="spEntriesListTitle">
      <a>
        <xsl:attribute name="href">
          <xsl:value-of select="url" />
        </xsl:attribute>
      
        <xsl:choose>
          <xsl:when test="string-length(name) &gt; 0">
            <xsl:value-of select="name" />
          </xsl:when>
          <xsl:otherwise>
            <xsl:value-of select="fields/field_name/data" />
          </xsl:otherwise>
        </xsl:choose>
      </a>

    </span>
	
	<div class="spField" id="title">
	  <xsl:value-of select="fields/field_title/data"/>
	  <xsl:text> </xsl:text>
	  <xsl:value-of select="fields/field_title/@suffix"/>
	</div>  
	
	<div class="spField" id="resume_activite">
	
		<xsl:if test="string-length(fields/field_logo/data/@image) &gt; 0">
					<div id="logo" class="SPField">
						
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
	
		<xsl:value-of select="fields/field_resume_activite/data" disable-output-escaping="yes"/>
		<xsl:text> </xsl:text>
		<xsl:value-of select="fields/field_resume_activite/@suffix"/>
		
    </div>    
	
	<xsl:if test="string-length(fields/field_lieux_de_vente/data) &gt; 0">
		<div class="spField list" id="lieuxdevente">			
			<strong><xsl:text>Lieux de vente : </xsl:text></strong>	
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
	
	<div class="spField list" id="productionsprincipales">
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
	<div class="spField list" id="produitsderives">
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
	<div class="spField list" id="caracteristiques">
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
    <div class="spEntryFooter">
      <div style="float:left"><xsl:call-template name="ratingStars"/></div>
      <div style="float:right"><xsl:value-of select="mjradius" disable-output-escaping="yes" /></div>
    </div>
	
	<div style="clear:both;"/>
		
	<xsl:if test="count(categories)">
          <div class="spEntryCats">
            <xsl:value-of select="php:function( 'SobiPro::Txt' , 'Catégorie(s):' )" /><xsl:text> </xsl:text>
            <xsl:for-each select="categories/category">
             
              <xsl:value-of select="." />
  
              <xsl:if test="position() != last()">
              <xsl:text> | </xsl:text>
              </xsl:if>
            </xsl:for-each>
          </div>
        </xsl:if>


  </xsl:template>
</xsl:stylesheet>
