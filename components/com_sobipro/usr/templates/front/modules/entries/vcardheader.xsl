<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
<xsl:output method="xml" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" encoding="UTF-8"/>
<xsl:template name="vcardheader">

						<xsl:if test="string-length(fields/field_logo/data/@thumbnail) &gt; 0">
							<div id="logo" class="SPField pull-left">							
								<xsl:element name="img">
								  <xsl:attribute name="src">
								  <xsl:value-of select="fields/field_logo/data/@thumbnail" />
								  </xsl:attribute>
								  <xsl:attribute name="alt">
									<xsl:choose>
									<xsl:when test="string-length(name) &gt; 0">
									<xsl:value-of select="name" />
									</xsl:when>
									<xsl:otherwise>
										<xsl:value-of select="fields/field_name/data" />
									</xsl:otherwise>
									</xsl:choose>
								  </xsl:attribute>
								</xsl:element>							
							</div>
						</xsl:if>
						
						<div class="spField" id="titre">
						
							<xsl:choose>
							  <xsl:when test="string-length(name) &gt; 0">
								<xsl:value-of select="name" />
							  </xsl:when>
							  <xsl:otherwise>
								<xsl:value-of select="fields/field_name/data" />
							  </xsl:otherwise>
							</xsl:choose>
							
						
						</div>
												
						
						
						<div class="spField" id="localisation">
								  <span>
									  <xsl:value-of select="fields/field_zip/data"/>
									  <xsl:text> </xsl:text>
									  <xsl:value-of select="fields/field_zip/@suffix"/>
								  </span>
								  <span>
									  <xsl:value-of select="fields/field_city/data"/>
									  <xsl:text> </xsl:text>
									  <xsl:value-of select="fields/field_city/@suffix"/>
								  </span>
						</div>
					
						<div class="spField" id="categorie">
							<xsl:if test="count(categories)">				
								<xsl:for-each select="categories/category">
								  <xsl:value-of select="." /><br/>		  
								</xsl:for-each>		
							</xsl:if>
						</div>	
						
</xsl:template>
</xsl:stylesheet>