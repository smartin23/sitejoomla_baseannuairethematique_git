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
          <xsl:value-of select="fields/field_resume_activite/data" disable-output-escaping="yes"/>
          <xsl:text> </xsl:text>
          <xsl:value-of select="fields/field_resume_activite/@suffix"/>
    </div>    
	
	<div class="spField" id="productions">

		<xsl:for-each select="fields/field_productions_principales/options/*">
		   <xsl:choose>
			  <xsl:when test="./@selected = 'true'">      
				  <xsl:value-of select="."/>				
				  <xsl:text>, </xsl:text>

			  </xsl:when>		 
		   </xsl:choose>
		</xsl:for-each>
		
		<xsl:for-each select="fields/field_produits_derives/options/*">
		   <xsl:choose>
			  <xsl:when test="./@selected = 'true'">      
				  <xsl:value-of select="."/>
					<xsl:text>, </xsl:text>				  
			  </xsl:when>			 
		   </xsl:choose>
		</xsl:for-each>
		<div style="clear:both;"/>
		<span class="spField" id="bio">
			<xsl:text>Production </xsl:text>
			<xsl:for-each select="fields/field_bio/options/*">
			   <xsl:choose>
				  <xsl:when test="./@selected = 'true'">      
					  <xsl:value-of select="."/>
					  <xsl:text>,</xsl:text>
				  </xsl:when>			 
			   </xsl:choose>
			</xsl:for-each>
		</span>
	
	</div>
    
    <div style="clear:both;"/>
    
    <div class="spEntryFooter">
      <div style="float:left"><xsl:call-template name="ratingStars"/></div>
      <div style="float:right"><xsl:value-of select="mjradius" disable-output-escaping="yes" /></div>
    </div>

  </xsl:template>
</xsl:stylesheet>
